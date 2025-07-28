<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LikeController extends Controller
{
    public function store($id)
    {
        $post = Post::findOrFail($id);

        $alreadyLiked = $post->likes()->where('user_id', Auth::id())->exists();

        if(!$alreadyLiked){
            $post->likes()->create(['user_id' => Auth::id()]);
        }
        return back();
    }

    public function destroy($id)
    {
      $post = Post::findOrFail($id);

      $post->likes()->where('user_id', Auth::id())->delete();
      return back();
    }
}
