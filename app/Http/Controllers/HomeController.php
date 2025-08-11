<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SkillEvaluation;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index()
{
    $studentId = Auth::id();

    // 平均値（なければ 0 に）
    $speakingAvg  = round((float) SkillEvaluation::where('student_id', $studentId)->avg('speaking'), 1);
    $writingAvg   = round((float) SkillEvaluation::where('student_id', $studentId)->avg('writing'), 1);
    $listeningAvg = round((float) SkillEvaluation::where('student_id', $studentId)->avg('listening'), 1);
    $readingAvg   = round((float) SkillEvaluation::where('student_id', $studentId)->avg('reading'), 1);
    $grammarAvg   = round((float) SkillEvaluation::where('student_id', $studentId)->avg('grammar'), 1);

    // 4技能の平均（grammar は除外）
    $overallAvg = round(($speakingAvg + $writingAvg + $listeningAvg + $readingAvg) / 4, 1);

    // ランク判定
    $level = match (true) {
        $overallAvg < 2.5 => 'Beginner',
        $overallAvg < 4.0 => 'Intermediate',
        default           => 'Advanced',
    };

    // ランク別教材
    $materials = match ($level) {
        'Beginner' => [
            'speaking'  => 'Beginner speaking',
            'writing'   => 'Beginner writing',
            'listening' => 'Beginner listening',
            'reading'   => 'Beginner reading',
        ],
        'Intermediate' => [
            'speaking'  => 'Intermediate speaking',
            'writing'   => 'Intermediate writing',
            'listening' => 'Intermediate listening',
            'reading'   => 'Intermediate reading',
        ],
        default => [ // Advanced
            'speaking'  => 'Advanced speaking',
            'writing'   => 'Advanced writing',
            'listening' => 'Advanced listening',
            'reading'   => 'Advanced reading',
        ],
    };

    return view('home', [
        'speakingAvg'  => $speakingAvg,
        'writingAvg'   => $writingAvg,
        'listeningAvg' => $listeningAvg,
        'readingAvg'   => $readingAvg,
        'grammarAvg'   => $grammarAvg,
        'overallAvg'   => $overallAvg,
        'level'        => $level,
        'materials'    => $materials,
    ]);
}
}
