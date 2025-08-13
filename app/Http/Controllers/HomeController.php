<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SkillEvaluation;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 生徒用ダッシュボード
    public function studentHome()
    {
        $studentId = Auth::id();

        // 平均値（なければ 0 に）
        $speakingAvg  = round((float) SkillEvaluation::where('student_id', $studentId)->avg('speaking'), 1);
        $writingAvg   = round((float) SkillEvaluation::where('student_id', $studentId)->avg('writing'), 1);
        $listeningAvg = round((float) SkillEvaluation::where('student_id', $studentId)->avg('listening'), 1);
        $readingAvg   = round((float) SkillEvaluation::where('student_id', $studentId)->avg('reading'), 1);
        $grammarAvg   = round((float) SkillEvaluation::where('student_id', $studentId)->avg('grammar'), 1);

        $overallAvg = round(($speakingAvg + $writingAvg + $listeningAvg + $readingAvg) / 4, 1);

        $level = match (true) {
            $overallAvg < 2.5 => 'Beginner',
            $overallAvg < 4.0 => 'Intermediate',
            default           => 'Advanced',
        };

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
            default => [
                'speaking'  => 'Advanced speaking',
                'writing'   => 'Advanced writing',
                'listening' => 'Advanced listening',
                'reading'   => 'Advanced reading',
            ],
        };

        $todayCount = SkillEvaluation::where('student_id', $studentId)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $dailyTarget = 10;
        $progressRatio = min($todayCount / $dailyTarget, 1);

        return view('home', compact(
            'speakingAvg',
            'writingAvg',
            'listeningAvg',
            'readingAvg',
            'grammarAvg',
            'overallAvg',
            'level',
            'materials',
            'progressRatio',
            'todayCount',
            'dailyTarget'
        ));
    }

    // 先生用ダッシュボード
    public function teacherHome()
    {
        return view('teacher.evaluations.home');
    }
}
