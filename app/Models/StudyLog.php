<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyLog extends Model
{
    protected $fillable = ['user_id', 'studied_at', 'minutes', 'memo'];
    protected $casts = ['studied_at' => 'date'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
