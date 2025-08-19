<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{


    public function create()
    {
        return view('blog_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'caption'    => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('posts', 'public');
        } else {
            $data['image_path'] = null;
        }

        $data['user_id'] = Auth::id();
        Post::create($data);

        return redirect()->route('student.home');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        abort_if($post->user_id !== Auth::id(), 403);

        return view('blog_edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'caption'    => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $post = Post::findOrFail($id);
        abort_if($post->user_id !== Auth::id(), 403);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('blog_view', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        abort_if($post->user_id !== Auth::id(), 403);

        $post->delete();
        return redirect()->route('posts.index');
    }
}
