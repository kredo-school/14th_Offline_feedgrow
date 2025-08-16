@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}">

<div class="blog-wrapper">
    <div class="blog-create-header">
            <a href="{{ route('student.home') }}" class="back-btn-create back-btn-create--pill">
                <span class="chev">←</span> Back
            </a>
        </div>
    <form class="blog-create-card" method="POST" action="{{route('blogs.update', $post->id)}}" enctype="multipart/form-data">
        @csrf

        @if($error->any())
        <ul class="text-danger mb-3">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>

        <div class="form-group">
            <h2 for="title">TITLE</h2>
            <input type="text" name="title" id="title" value="{{'title', $post->title}}" required>
        </div>

        <div class="form-group">
            <label for="date">DATE</label>
            <input type="date" name="date" id="date" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}">
        </div>

        <div class="form-group">
            <textarea name="content" id="content" rows="6" placeholder="Write your blog...">{{old ('caption', $post->caption)}}</textarea>
        </div>

        <div class="form-group">
      @if ($post->image_path)
        <div class="mb-2">
          <img src="{{ asset('storage/' . $post->image_path) }}" alt="current image" style="max-width: 240px;">
        </div>
      @endif
      <input type="file" name="image_path" accept="image/*">
    </div>

        <div class="form-buttons">
            <button type="submit" class="post-btn">EDIT</button>
        </div>
    </form>
</div>
@endsection
