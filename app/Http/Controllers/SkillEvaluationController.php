<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SkillEvaluation;

class SkillEvaluationController extends Controller
{
    public function index()
    {
        $studentId = Auth::id();
        $feedbacks = SkillEvaluation::where('student_id', $studentId)->get();
        return view('feedback_history', compact('feedbacks'));
    }

    public function searchForm()
    {
        return view('teacher.evaluations.search');
    }

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

    public function create($student)
    {
        $student = User::where('role', 'student')->findOrFail($student);
        return view('teacher.evaluations.create', compact('student'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'speaking'   => 'nullable|integer|min:1|max:5',
            'listening'  => 'nullable|integer|min:1|max:5',
            'reading'    => 'nullable|integer|min:1|max:5',
            'writing'    => 'nullable|integer|min:1|max:5',
            'grammar'    => 'nullable|integer|min:1|max:5',
            'comment'    => 'nullable|string',
        ]);

        SkillEvaluation::create([
            'teacher_id' => auth()->id(),
            'student_id' => $data['student_id'],
            'speaking'   => $data['speaking'],
            'listening'  => $data['listening'],
            'reading'    => $data['reading'],
            'writing'    => $data['writing'],
            'grammar'    => $data['grammar'],
            'comment'    => $data['comment'],
        ]);

        return redirect()
            ->route('evaluations.search.form')
            ->with('success', 'Rating submitted');
    }
}
