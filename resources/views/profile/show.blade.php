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
                            {{-- <i class="fa-solid fa-user fa-8x avatar pt-4" style="color:#c7cedc;"></i> --}}
                            <i class="fa-solid fa-user avatar rounded-circle"></i>
                        @endif

                    </div>
                    <h4 class="role">STUDENT</h4>
                </div>
                <div class="profile-right">
                    <label>NAME</label>
                    <p>{{ $user->name }}</p>

                    @can('viewEmail', $user)
                        <div class="form-row">
                            <div class="form-group">
                                <label>EMAIL</label>
                                <p>{{ $user->email }}</p>
                            </div>
                        @endcan

                        @can('viewPassword', $user)
                            <div class="form-group">
                                <label>PASSWORD</label>
                                <p>・・・・・・・・</p>
                            </div>
                        </div>
                    @endcan


                    <label>INTRODUCTION</label>
                    <div class="profile-textarea">{{ $user->introduction }}</div>

                    @can('viewEdit', $user)
                        <div class="form-buttons">
                            <a href="{{ route('profile.edit') }}" class="btn save-btn">EDIT</a>
                        </div>
                    @endcan

                </div>
            </form>
        </div>



        <div class="my-posts">
            @forelse($user->posts as $post)
                <div class="post-card">
                    <div class="post-media">

                        {{-- 画像 --}}
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                                class="post-thumbnail">
                        @else
                            <img src="{{ asset('images/default-thumbnail.png') }}" alt="No Image" class="post-thumbnail">
                        @endif
                    </div>

                    {{-- タイトル --}}
                    <div class="post-header">
                        <h3 class="post-title">
                            <a href="{{ route('posts.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        {{-- @canany(['update', 'delete'], $post)
                            <div class="menu-wrapper">
                                <button onclick="toggleMenu(this)" type="button" class="menu-btn">⋯</button>
                                <div class="menu-options">
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span class="text-primary">Edit</span>
                                        </a>
                                    @endcan

                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            onsubmit="return confirm('Do you want to delete it?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="menu-item text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @endcanany --}}
                        @canany(['update', 'delete'], $post)
                            <div class="menu-wrapper"  style="position: relative; text-align: right;">
                                <button onclick="toggleMenu(this)" type="button" class="menu-btn">⋯</button>
                                <div class="menu-options">
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post->id) }}" class="icon-btn icon-edit" title="Edit"
                                            aria-label="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    @endcan

                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirm('Do you want to delete it?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="icon-btn icon-danger" title="Delete" aria-label="Delete">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @endcanany
                    </div>
                </div>
            @empty
                {{-- <p>No blog posts yet.</p> --}}
                <div class="post-card empty">
                    <div class="empty-inner">
                        <i class="fa-regular fa-file-lines fa-2x"></i>
                        <p>No blog posts yet.</p>
                        {{-- 置きたいなら作成ボタンも --}}
                        {{-- <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">Write your first post</a> --}}
                    </div>
                </div>
            @endforelse
        </div>

        <script>
            function toggleMenu(button) {
                const menu = button.nextElementSibling;
                const isVisible = menu.style.display === "block";
                document.querySelectorAll(".menu-options").forEach(m => m.style.display = "none");
                if (!isVisible) menu.style.display = "block";
            }
            document.addEventListener("click", (e) => {
                if (!e.target.closest(".menu-wrapper")) {
                    document.querySelectorAll(".menu-options").forEach(m => m.style.display = "none");
                }
            });
        </script>
    @endsection
