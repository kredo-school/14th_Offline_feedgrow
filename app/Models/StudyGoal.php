<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyGoal extends Model
{
    protected $fillable = ['user_id', 'week_start_date', 'target_minutes'];
    protected $casts = ['week_start_date' => 'date'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
