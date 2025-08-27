<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillEvaluation extends Model
{
    protected $fillable = [
        'teacher_id',  'student_id', 'lesson', 'evaluated_at', 'speaking', 'listening', 'reading', 'writing', 'grammar', 'comment',
    ];

    protected $casts = [
        'evaluated_at' => 'date',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    
}
