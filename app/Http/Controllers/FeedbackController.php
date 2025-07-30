<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = [
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'lesson' => 'Basic English',
                'speaking' => 5,
                'listening' => 4,
                'writing' => 5,
                'reading' => 4,
                'grammar' => 5,
                'date' => '2025-07-30',
            ],
            [
                'user' => ['name' => 'Mark', 'avatar' => 'teacher_2.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-29',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-24',
            ],
            [
                'user' => ['name' => 'Mark', 'avatar' => 'teacher_2.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-22',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-20',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-19',
            ],
            [
                'user' => ['name' => 'Mark', 'avatar' => 'teacher_2.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-18',
            ],
            [
                'user' => ['name' => 'Mark', 'avatar' => 'teacher_2.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-16',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'lesson' => 'Business English',
                'speaking' => 4,
                'listening' => 5,
                'writing' => 4,
                'reading' => 5,
                'grammar' => 4,
                'date' => '2025-07-15',
            ],
        ];

        return view('feedback_history', compact('feedbacks'));
}
}


