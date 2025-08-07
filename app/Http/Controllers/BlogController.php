<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
        public function show($id)
    {
        $blog = [
            'user' => ['name' => 'Ema', 'avatar' => 'teacher_1.jpg'],
            'title' => 'Dinner',
            'created_at' => '2025/07/30',
            'image' => 'bbq.jpg'
        ];
        return view('blog_view', compact('blog'));
    }

    public function create()
    {
        return view('blog_create');
    }

    public function edit()
    {
        return view('blog_edit');
    }
}
