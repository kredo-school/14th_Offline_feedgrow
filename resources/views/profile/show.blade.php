@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="profile-container">
        <div class="profile-header">
            <a href="{{ route('student.home') }}" class="back-btn back-btn--pill">
                <span class="chev">←</span> Back
            </a>
            <h1 class="profile-title fw-bold">PROFILE</h1>
        </div>
        <div class="profile-card">
            <form class="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-left">
                    <div class="avatar-container">
                        @if (!empty($user->profile_image))
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="User Avatar" class="avatar">
                        @else
                            <i class="fa-solid fa-user fa-8x avatar pt-4" style="color:#c7cedc;"></i>
                        @endif

                    </div>
                    <h4 class="role">STUDENT</h4>
                </div>
                <div class="profile-right">
                    <label>NAME</label>
                    <p>{{ $user->name }}</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label>EMAIL</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <p>・・・・・・・・</p>
                        </div>
                    </div>

                    <label>INTRODUCTION</label>
                    <div class="profile-textarea">{{ $user->introduction }}</div>

                    <div class="form-buttons">
                        {{-- <button type="submit" class="btn save-btn">EDIT</button> --}}
                       <a href="{{ route('profile.edit') }}" class="btn save-btn">EDIT</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="my-posts">
            @forelse($user->posts as $post)
                <div class="post-card">
                    {{-- 画像 --}}
                    @if ($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                            class="post-thumbnail">
                    @else
                        <img src="{{ asset('images/default-thumbnail.png') }}" alt="No Image" class="post-thumbnail">
                    @endif

                    {{-- タイトル --}}
                    <h3>
                        <a href="{{ route('posts.show', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h3>
                </div>
            @empty
                <p>No blog posts yet.</p>
            @endforelse
        </div>
    </div>
@endsection
