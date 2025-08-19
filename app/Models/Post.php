<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{
    

    protected $fillable = [
        'user_id',
        'title',
        'image_path',
        'caption',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
      public function comments()
      {
        return $this->hasMany(Comment::class);
      }
      public function isLiked(?int $userId = null): bool
    {
        $userId = $userId ?? auth()->id();
        if (!$userId) return false;

        if ($this->relationLoaded('likes')) {
            return $this->likes->contains('user_id', $userId);
        }
        return $this->likes()->where('user_id', $userId)->exists();
    }

}
