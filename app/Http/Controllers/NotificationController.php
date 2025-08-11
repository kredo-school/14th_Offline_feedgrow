<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function index()
    {
        $notifications = [
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],
            [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Dinner',
                'created_at' => '2025/07/30',
            ],

        ];

        return view('notification.index', compact('notifications'));
    }

}
