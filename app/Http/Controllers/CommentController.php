<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $post = Post::findOrFail($id);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back();
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if($comment->user_id !== Auth::id()){
            abort(403, 'Unauthorized action.');
        }
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);
        $comment = Comment::findOrFail($id);

        if($comment->user_id !== Auth::id()){
            abort(403, 'Unauthorized action.');
        }

        $comment->update([
            'body' => $request->body,
        ]);
        return redirect()->route('posts.show', $comment->post_id);
    }
    public function destroy($id)
    {
       $comment = Comment::findOrFail($id);

        if($comment->user_id !== Auth::id())
        {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();
        return back();
    }
}
