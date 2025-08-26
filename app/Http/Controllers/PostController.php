<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        // すべてのアクションにログイン必須（必要に応じて調整）
        $this->middleware('auth')->except(['show']);
    }

    public function create()
    {
        return view('blog_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'image_path'    => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'caption'       => 'nullable|string|max:255',
            'published_at'  => 'nullable|date',
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('posts', 'public');
        }

        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        // 作成後の遷移はお好みで
        return redirect()->route('posts.show', $post->id);
        // return redirect()->route('student.home');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('blog_edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'caption'       => 'nullable|string|max:255',
            'image_path'    => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'published_at'  => 'nullable|date',
            'remove_image'  => 'nullable|boolean',
        ]);

        // 画像削除
        if ($request->boolean('remove_image') && $post->image_path) {
            Storage::disk('public')->delete($post->image_path);
            $data['image_path'] = null;
        }

        // 新規アップロード（既存があれば削除して差し替え）
        if ($request->hasFile('image_path')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.show', $post->id);
    }

    public function show(Post $post)
    {
        // ルートで {post} を使えばこれでOK（with('user') が必要ならモデル側で eager load するか、ここで $post->load('user')）
        $post->load('user');
        return view('blog_view', compact('post'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // 画像があれば物理削除
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect()->route('student.home');
    }
}
