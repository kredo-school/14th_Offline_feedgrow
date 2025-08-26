@extends('layouts.appTe')
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
            <form class="profile-form" action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-left">
                    <div class="avatar-container">
                        @if (!empty($user->profile_image))
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="User Avatar" class="avatar">
                        @else
                            <i class="fa-solid fa-user fa-8x avatar pt-4" style="color:#c7cedc;"></i>
                        @endif
                        <label for="profile_image" class="edit-icon">
                            <i class="fa-solid fa-pen-to-square me-3 fa-2x"></i>
                        </label>
                        <input type="file" id="profile_image" name="profile_image" style="display: none;">
                    </div>
                    <h4 class="role">TEACHER</h4>
                </div>
                <div class="profile-right">
                    <label>NAME</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}">

                    <div class="form-row">
                        <div class="form-group">
                            <label>EMAIL</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input type="password" name="password" placeholder="・・・・・・・・">
                        </div>
                    </div>

                    <label>INTRODUCTION</label>
                    <textarea name="introduction" rows="4">{{ old('introduction', $user->introduction) }}</textarea>

                    <div class="form-buttons">
                        <button type="submit" class="btn save-btn">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
