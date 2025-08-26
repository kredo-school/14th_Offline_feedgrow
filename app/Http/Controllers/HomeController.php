<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SkillEvaluation;
use App\Models\Post;
use App\Models\StudyGoal;
use App\Models\StudyLog;
use Carbon\Carbon;

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

        $dailyTarget = 8;
        $progressRatio = min($todayCount / $dailyTarget, 1);

        $posts = Post::with('user')->orderByDesc('created_at')->take(30)->get();

$weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY);
    $weekEnd   = (clone $weekStart)->endOfWeek(Carbon::SUNDAY);

    $goal = StudyGoal::where('user_id', $studentId)
        ->where('week_start_date', $weekStart->toDateString())
        ->first();

    $weekMinutes = StudyLog::where('user_id', $studentId)
        ->whereBetween('studied_at', [$weekStart->toDateString(), $weekEnd->toDateString()])
        ->sum('minutes');

    $totalMinutes = StudyLog::where('user_id', $studentId)->sum('minutes');

    $target   = $goal?->target_minutes ?? 0;
    $progress = $target > 0 ? floor($weekMinutes * 100 / $target) : 0;
    if ($progress > 100) $progress = 100;
    $remaining = max(0, $target - $weekMinutes);

    $logs = StudyLog::where('user_id', $studentId)
        ->orderBy('studied_at','desc')->orderBy('created_at','desc')
        ->paginate(20);

    // 専用ビューに“両方”渡す
    return view('home', compact(
        // 英語スキル
        'speakingAvg','writingAvg','listeningAvg','readingAvg','grammarAvg',
        'overallAvg','level','materials','progressRatio','todayCount','dailyTarget','posts',
        // 学習
        'goal','weekStart','weekEnd','weekMinutes','totalMinutes','progress','remaining','target','logs'
    ));
}


    // 先生用ダッシュボード
    public function teacherHome()
    {
        return view('teacher.evaluations.home');
    }
}
