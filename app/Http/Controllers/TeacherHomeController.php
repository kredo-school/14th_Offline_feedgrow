<?php

// app/Http/Controllers/TeacherHomeController.php
namespace App\Http\Controllers;

use App\Models\SkillEvaluation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherHomeController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        // 先生が評価した生徒ごとの最新 created_at を集計
        $sub = SkillEvaluation::select([
                'student_id',
                DB::raw('MAX(created_at) AS last_evaluated_at'),
            ])
            ->where('teacher_id', $teacherId)
            ->groupBy('student_id');

        // users と結合して一覧化（最新順）
        $students = User::query()
            ->joinSub($sub, 'e', fn($j) => $j->on('users.id', '=', 'e.student_id'))
            ->select('users.*', 'e.last_evaluated_at')
            ->orderByDesc('e.last_evaluated_at')
            ->paginate(10)
            ->withQueryString();

        return view('teacher.evaluations.home', compact('students'));
    }
}
