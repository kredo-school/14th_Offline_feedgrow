@extends('layouts.app')

@section('title', 'blog Edit')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    {{-- FlatpickrのCSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



    <div class="blog-wrapper">
        <div class="blog-create-header">
            <a href="{{ route('posts.show', $post->id) }}" class="back-btn-create back-btn-create--pill">
                <span class="chev">←</span> Back
            </a>

        </div>
        <form class="blog-create-card" method="POST" action="{{ route('posts.update', $post->id) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <h2 for="title">TITLE</h2>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="published_at">DATE</label>
                <input type="date" name="published_at" id="published_at"
                    value="{{ old('published_at', $post->published_at) }}" class="blog-date">
                @error('published_at')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <textarea name="caption" id="caption" rows="6" placeholder="Write your blog...">{{ old('caption', $post->caption) }}</textarea>
                @error('caption')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                @if ($post->image_path)
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="current image"
                            style="max-width: 240px; height: auto; display:block; margin-bottom:8px;">
                    </div>
                @endif

                <div class="form-group">
                    <input type="file" name="image_path" accept="image/*">
                    @error('image_path')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                @error('image_path')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit" class="post-btn">SAVE</button>
            </div>
        </form>
    </div>

    {{-- FlatpickrのJS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at", {
            dateFormat: "Y-m-d", // 例: 2025-08-16
            locale: "en" // 英語表示に固定
        });
    </script>
@endsection
