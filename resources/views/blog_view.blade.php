@extends('layouts.app')

@section('title', 'Blog View')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <div class="blog-wrapper">
        <div class="blog-header">
            <a href="{{ route('student.home') }}" class="back-btn back-btn--pill">
                <span class="chev">←</span> Back
            </a>
            <h1 class="blog-title fw-bold">BLOG</h1>
        </div>
        <div class="blog-card">
            <!-- 投稿タイトルと日付 -->
            <div class="title-wrapper">
                <h2 class="post-title">{{ $post['title'] }}</h2>
                <small class="text-muted post-date" style="font-size: 14px;">{{ $post['created_at'] }}</small>
            </div>

            <!-- 投稿者 -->
            <div class="user-info">
                @if(optional($post->user)->profile_image)
    <img
      class="blog-avatar new rounded-circle"
      data-user="{{ $post->user_id }}"
      src="{{ asset('storage/' . optional($post->user)->profile_image) }}"  {{-- 可能なら Storage::url(...) 推奨 --}}
      alt="{{ optional($post->user)->name ? $post->user->name.'の投稿' : 'User' }}"
      loading="lazy"
    >
  @else
    <i class="fa-solid fa-user blog-avatar new rounded-circle"
       data-user="{{ $post->user_id }}"></i>
  @endif
                <span class="fw-bold">{{ $post['user']['name'] }}</span>
            </div>

            <!-- 本文 -->
            <div class="post-body">
                <p>{{ $post['caption'] }}</p>
            </div>

            <!-- 画像 -->
            @if (!empty($post->image_path))
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="blog image" class="post-image">
            @endif

            <!-- アイコン -->
            <div class="icons">
                <div>
                    <i class="far fa-heart"></i>
                    <i class="far fa-comment ms-3"></i>
                </div>

                <div class="menu-wrapper" style="position: relative; text-align: right;">
                    <button onclick="toggleMenu()" class="menu-btn">⋯</button>

                    <div id="menu-options" class="menu-options">

                        <a href="#"><i class="fa-solid fa-pen-to-square"></i>
                            <span class="text-primary">Edit</span></a>

                        <a href="#"><i class="fa-solid fa-trash"></i>
                            <span class="text-danger">Delete</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggleMenu() {
        const menu = document.getElementById('menu-options');
        if (!menu) return;
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
</script>
