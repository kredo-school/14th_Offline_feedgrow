<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostLiked;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $post->likes()->firstOrCreate(['user_id' => Auth::id()]);

    if ($post->user_id !== Auth::id()) {
        $post->user->notify(new PostLiked(Auth::user(), $post));
    }

    if ($request->expectsJson()) {
        return response()->json([
            'liked' => true,
            'count' => $post->likes()->count(),
        ]);
    }
    return back()->withFragment('post-'.$post->id);
}

public function destroy(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $post->likes()->where('user_id', Auth::id())->delete();

    if ($request->expectsJson()) {
        return response()->json([
            'liked' => false,
            'count' => $post->likes()->count(),
        ]);
    }
    return back()->withFragment('post-'.$post->id);
}
}
