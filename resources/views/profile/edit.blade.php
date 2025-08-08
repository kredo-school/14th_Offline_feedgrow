{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container">
    <div class="profile-header">
            <a href="{{ route('home') }}" class="back-btn back-btn--pill">
                <span class="chev">←</span> Back
            </a>
            <h1 class="profile-title fw-bold">PROFILE</h1>
        </div>
    <div class="profile-card">
        <div class="profile-left">
            <div class="avatar-container">
                <img src="{{ asset('images/daiki_icon.jpg') }}" alt="Avatar" class="avatar">
                <label for="profile_image" class="edit-icon">
                    <i class="fa-solid fa-pen-to-square me-3 fa-2x"></i>
                </label>
                <input type="file" id="profile_image" name="profile_image" style="display: none;">
            </div>
            <h4 class="role">STUDENT</h4>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-right">
            @csrf

            <label>NAME</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">

            <div class="form-row">
                <div class="form-group">
                    <label>EMAIL</label>
                    <input type="email" name="email" value="{{ old('name', $user->email) }}">
                </div>

                <div class="form-group">
                    <label>PASSWORD</label>
                    <input type="password" name="password" placeholder="・・・・・・・・">
                </div>
            </div>

            <label>INTRODUCTION</label>
            <textarea name="introduction" rows="4">{{ old('name', $user->introduction) }}</textarea>

            <div class="form-buttons">
                <button type="submit" class="btn save-btn">SAVE</button>
            </div>
        </form>
    </div>
</div>
@endsection



