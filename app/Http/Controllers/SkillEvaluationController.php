<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

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
}
