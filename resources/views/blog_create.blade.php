@extends('layouts.app')

@section('title', 'New Blog')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}">

<div class="blog-wrapper">
 <form class="blog-create-card" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <h2 for="title">TITLE</h2>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="date">DATE</label>
            <input type="date" name="date" id="date" required>
        </div>

        <div class="form-group">
            <textarea name="content" id="content" rows="6" placeholder="Write your blog..."></textarea>
        </div>

        <div class="form-group">
            <input type="file" name="image">
        </div>

        <div class="form-buttons">
            <button type="submit" class="back-btn-create">BACK</button>
            <button type="submit" class="post-btn">POST</button>
        </div>
    </form>
</div>
@endsection
