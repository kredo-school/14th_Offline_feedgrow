@extends('layouts.app')

@section('title', 'New Blog')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    {{-- FlatpickrのCSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="blog-wrapper">
        <div class="blog-create-header">
            <a href="{{ route('student.home') }}" class="back-btn-create back-btn-create--pill">
                <span class="chev">←</span> Back
            </a>

        </div>
        <form class="blog-create-card" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <h2 for="title">TITLE</h2>
                <input type="text" name="title" id="title" required>
            </div>

            {{-- <div class="form-group">
                <label for="date">DATE</label>
                <input type="date" name="published_at" id="published_at" required>
            </div> --}}

            <div class="form-group">
                <label for="published_at">DATE</label>
                {{-- 普通のdateではなく text にする（flatpickrを使う） --}}
                <input type="text" name="published_at" id="published_at" class="blog-date" required placeholder="YYYY-MM-DD">
            </div>

            <div class="form-group">
                <textarea name="caption" id="caption" rows="6" placeholder="Write your blog..."></textarea>
            </div>

            <div class="form-group">
                <input type="file" name="image_path" accept="image/*">
            </div>

            <div class="form-buttons">
                <button type="submit" class="post-btn">POST</button>
            </div>
        </form>
    </div>

     {{-- FlatpickrのJS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at", {
            dateFormat: "Y-m-d", // 例: 2025-08-16
            locale: "en"        // 英語表示に固定
        });
    </script>

@endsection
