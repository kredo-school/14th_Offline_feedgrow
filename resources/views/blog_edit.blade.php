@extends('layouts.app')

@section('title', 'blog Edit')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">


    <div class="blog-wrapper">
        <div class="blog-create-header">
            <a href="{{ route('student.home') }}" class="back-btn-create back-btn-create--pill">
                <span class="chev">←</span> Back
            </a>

        </div>
        <form class="blog-create-card" method="POST" action="{{ route('posts.update', $post->id) }}"
            enctype="multipart/form-data">
            @csrf


            <div class="form-group">
                <h2 for="title">TITLE</h2>
                <input type="text" name="title" id="title"
             value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="published_at">DATE</label>
                 <input type="date" name="published_at" id="published_at"
             value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}">
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
      <button type="submit" class="post-btn">UPDATE</button>
    </div>
  </form>
</div>
@endsection
