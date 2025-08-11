<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function show($id)
    {
        $notifications = [
            'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
            'title' => 'Dinner',
            'created_at' => '2025/07/30',
        ];
        return view('notification', compact('notification'));
    }

}
