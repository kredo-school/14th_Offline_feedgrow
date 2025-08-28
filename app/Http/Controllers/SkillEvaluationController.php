<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\SkillEvaluation;
use App\Notifications\EvaluationReceived;
use App\Notifications\SkillEvaluated;

class SkillEvaluationController extends Controller
{
    // 生徒側: フィードバック履歴
    public function index()
    {
        $studentId = Auth::id();

        $feedbacks = SkillEvaluation::with('teacher')
            ->where('student_id', $studentId)
            ->orderByDesc(DB::raw('COALESCE(evaluated_at, created_at)')) // 最新順
            ->get();

        return view('feedback_history', compact('feedbacks'));
    }

    // 先生側: 検索フォーム
    public function searchForm()
    {
        return view('teacher.evaluations.search');
    }

    // 先生側: 検索結果
    public function searchResults(Request $request)
    {
        $q = $request->input('q', '');

        $students = User::where('role', 'student')
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%");
            })
            ->get();

        return view('teacher.evaluations.results', compact('students', 'q'));
    }

    // 評価作成フォーム
    public function create($student)
    {
        $student = User::where('role', 'student')->findOrFail($student);
        return view('teacher.evaluations.create', compact('student'));
    }

    // 評価保存処理
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id'   => 'required|exists:users,id',
            'lesson'       => 'nullable|string|max:100',
            'evaluated_at' => 'nullable|date',
            'speaking'     => 'nullable|integer|min:1|max:5',
            'listening'    => 'nullable|integer|min:1|max:5',
            'reading'      => 'nullable|integer|min:1|max:5',
            'writing'      => 'nullable|integer|min:1|max:5',
            'grammar'      => 'nullable|integer|min:1|max:5',
            'comment'      => 'nullable|string',
        ]);

        $evaluation = SkillEvaluation::create([
            'teacher_id'   => auth()->id(),
            'student_id'   => $data['student_id'],
            'lesson'       => $data['lesson'],
            'evaluated_at' => $data['evaluated_at'],
            'speaking'     => $data['speaking'],
            'listening'    => $data['listening'],
            'reading'      => $data['reading'],
            'writing'      => $data['writing'],
            'grammar'      => $data['grammar'],
            'comment'      => $data['comment'],
        ]);

        // 生徒に通知
        $student = User::findOrFail($data['student_id']);
        $student->notify(new EvaluationReceived(Auth::user(), $evaluation));

        // 先生のホームに戻ってフラッシュメッセージ表示
        return redirect()
            ->route('teacher.home')
            ->with('success', 'Evaluations sent to students');
    }

    public function allEvaluationsForStudent(User $student)
    {
        $this->authorize('viewAllEvaluationsForStudent', $student);

        $feedbacks = SkillEvaluation::with('teacher')
            ->where('student_id', $student->id)
            ->orderByDesc(DB::raw('COALESCE(evaluated_at, created_at)'))
            ->get();

            return view('teacher.evaluations.all_for_student', compact('student','feedbacks'));
    }
}
