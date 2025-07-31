@extends('layouts.app')

@section('title', 'Blog View')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <div class="blog-wrapper">
        <h1 class="blog-title fw-bold">BLOG</h1>

        <div class="blog-card">
            <!-- 投稿タイトルと日付 -->
            <div class="post-title text-center">
                <span class="mb-1">{{ $blog['title'] }}</sn>
                <small class="text-muted" style="font-size: 14px;">{{ $blog['created_at'] }}</small>
            </div>

            <!-- 投稿者 -->
            <div class="user-info">
                <img src="{{ asset('images/' . $blog['user']['avatar']) }}" alt="avatar">
                <span class="fw-bold">{{ $blog['user']['name'] }}</span>
            </div>

            <!-- 本文 -->
            <div class="post-body">
                I had BBQ with my friend for dinner today. It was delicious.
            </div>

            <!-- 画像 -->
            <img src="{{ asset('images/' . $blog['image']) }}" alt="blog image" class="post-image">

            <!-- アイコン -->
            <div class="icons">
                <div>
                    <i class="far fa-heart"></i>
                    <i class="far fa-comment ms-3"></i>
                </div>
                <div>
                    <i class="fas fa-ellipsis-h"></i>
                </div>
            </div>
        </div>

        <!-- 戻るボタン -->
        <div class="back-btn">
            <a href="{{}}">← BACK</a>
        </div>
    </div>
@endsection
