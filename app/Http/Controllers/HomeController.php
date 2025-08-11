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

    $speakingAvg = round(SkillEvaluation::where('student_id', $studentId)->avg('speaking'), 1);
    $writingAvg = round(SkillEvaluation::where('student_id', $studentId)->avg('writing'), 1);
    $listeningAvg = round(SkillEvaluation::where('student_id', $studentId)->avg('listening'), 1);
    $readingAvg = round(SkillEvaluation::where('student_id', $studentId)->avg('reading'), 1);
    $grammarAvg = round(SkillEvaluation::where('student_id', $studentId)->avg('grammar'), 1);

    return view('home', compact(
        'speakingAvg',
        'writingAvg',
        'listeningAvg',
        'readingAvg',
        'grammarAvg'
    ));

    
}
}
