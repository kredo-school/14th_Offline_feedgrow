{{-- resources/views/teacher/evaluations/all_for_student.blade.php --}}
@extends('layouts.appTe')
@section('title', 'Student Evaluations')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/feedback_history.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="profile-container">
        <div class="profile-header">
            <a href="{{ route('teacher.home') }}" class="back-btn back-btn--pill">
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
                    <p>{{ $student->name }}</p>

                    <label>INTRODUCTION</label>
                    <div class="profile-textarea">{{ $student->introduction }}</div>
                </div>
            </form>
        </div>
        <div class="my-posts">
            @forelse ($feedbacks as $fb)
                <div class="post-card">
                    <div class="feedback-card">
                        <div class="date small">
                            {{ optional($fb->evaluated_at)->format('Y年n月j日 H:i') ?? $fb->created_at->format('Y年n月j日 H:i') }}
                        </div>

                        @if (!empty($fb->lesson))
                            <div class="lesson"><small>Lesson:</small> {{ $fb->lesson }}</div>
                        @endif

                        <ul class="scores">
                            <li><span class="small">Speaking:</span> {{ $fb->speaking ?? '―' }}</li>
                            <li><span class="small">Listening:</span> {{ $fb->listening ?? '―' }}</li>
                            <li><span class="small">Reading:</span> {{ $fb->reading ?? '―' }}</li>
                            <li><span class="small">Writing:</span> {{ $fb->writing ?? '―' }}</li>
                            <li><span class="small">Grammar:</span> {{ $fb->grammar ?? '―' }}</li>
                        </ul>

                        @if (!empty($fb->comment))
                            <div class="comment"><small>Comment:</small> {{ $fb->comment }}</div>
                        @endif
                    </div>
                </div>
            @empty
                <p>No evaluations have been recorded yet.</p>
            @endforelse
        </div>
    </div>
@endsection
