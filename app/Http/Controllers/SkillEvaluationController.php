<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SkillEvaluation;
use Illuminate\Cache\Events\WritingKey;

class SkillEvaluationController extends Controller
{
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
        $student = User::Where('role', 'student')->findOrFail($student);
        return view('teacher.evaluations.create', compact('student'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'speaking' => 'nullable|integer|min:1|max:5',
            'listening' => 'nullable|integer|min:1|max:5',
            'reading' => 'nullable|integer|min:1|max:5',
            'writing' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $evaluation = SkillEvaluation::create([
            'teacher_id' => auth()->id(),
            'student_id' => $data['student_id'],
            'speaking' => $data['speaking'],
            'listening' => $data['listening'],
            'reading' => $data['reading'],
            'writing' => $data['writing'],
            'comment' => $data['comment'],
        ]);

        return redirect()->route('evaluations.search.form');
    }
}
