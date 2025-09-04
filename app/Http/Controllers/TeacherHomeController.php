<?php

// app/Http/Controllers/TeacherHomeController.php
namespace App\Http\Controllers;

use App\Models\SkillEvaluation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TeacherHomeController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        // 先生が評価した生徒ごとの最新 created_at を集計
         $sub = SkillEvaluation::select([
                'student_id',
                DB::raw('MAX(COALESCE(evaluated_at, created_at)) AS last_evaluated_at'),
            ])
            ->where('teacher_id', $teacherId)
            ->groupBy('student_id');

        // users と結合（評価が無い生徒も出したいので leftJoinSub）
        $students = User::query()
            ->where('role', 'student')
            ->leftJoinSub($sub, 'e', fn ($j) => $j->on('users.id', '=', 'e.student_id'))
            ->select('users.*', 'e.last_evaluated_at')
            ->orderByDesc('e.last_evaluated_at') // 直近の評価順に並べたい場合
            ->paginate(5);


        // Blade で format しやすいように Carbon 化
        $students->each(function ($s) {
            if ($s->last_evaluated_at) {
                $s->last_evaluated_at = Carbon::parse($s->last_evaluated_at);
            }
        });

        return view('teacher.evaluations.home', compact('students'));

    }
}

