<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = [
            'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
            'title' => 'Dinner',
            'created_at' => '2025/07/30',
            'image' => 'bbq.jpg'
        ];
        return view('profile_show', compact('profile'));
    }
}
