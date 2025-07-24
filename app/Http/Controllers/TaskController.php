<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Task;
use Illuminate\Auth\Events\Validated;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth()->id())->orderBy('due_date', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'due_date' => 'required|date'
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'due_date' => $validated['due_date'],
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index');
    }
    public function edit($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content'  => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        $task->update([
            'content' => $validated['content'],
            'due_date' => $validated['due_date'],
        ]);
        return redirect()->route('tasks.index');
    }
}

