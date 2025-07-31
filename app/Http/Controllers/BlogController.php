<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function show($id)
    {
        $blog = [
                'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
                'title' => 'Basic English',
                'created_at' => '2025/07/30',
                'image' => 'bbq.jpg'
        ];
        return view('blog_view', compact('blog'));
    }
}
