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

        $alreadyLiked = $post->likes()->where('user_id', Auth::id())->exists();
        if (! $alreadyLiked) {
            $post->likes()->create(['user_id' => Auth::id()]);
        }

        if ($post->user_id !== Auth::id()) {
            $post->user->notify(new PostLiked(Auth::user(), $post));
        }

        // ← fetch(…,{headers:{Accept:'application/json'}}) ならJSONで返す
        if ($request->expectsJson()) {
            return response()->json([
                'liked' => true,
                'count' => $post->likes()->count(),
            ]);
        }

        // フォールバック：通常フォームなら元の位置に戻す
        return back()->withFragment('post-' . $post->id);
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

        return back()->withFragment('post-' . $post->id);
    }
}
