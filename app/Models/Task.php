<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'content', 'due_date', 'is_completed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
