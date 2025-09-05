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
                            <i class="fa-solid fa-user avatar rounded-circle"></i>
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
            {{-- @forelse ($feedbacks as $fb)
                <div class="post-card">
                    <div class="feedback-card">
                        <div class="date small">
                            {{ $fb->created_at->format('Y-m-d') }}
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
            @endforelse --}}
            @forelse ($feedbacks as $feedback)
                <article class="fh-card2">
                    <div class="fh2-left"></div>

                    <div class="fh2-body">
                        <header class="fh2-head">
                            <div class="fh2-teacher">
                                @if (!empty($feedback->teacher->profile_image))
                                    <img src="{{ asset('storage/' . $feedback->teacher->profile_image) }}"
                                        alt="{{ $feedback->teacher->name ?? 'Teacher' }}" style="width:40px;height:40px;font-size:21px;color:#c7cedc;border:1px solid #888888;">
                                @else
                                    {{-- <i class="fa-solid fa-user fa-lg fallback-avatar"></i> --}}
                                    <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                style="width:40px;height:40px;font-size:21px;color:#c7cedc;border:1px solid #888888;"></i>
                                @endif
                                <span class="fh2-name">{{ $feedback->teacher->name ?? 'Teacher' }}</span>
                            </div>

                            <div class="fh2-meta">
                                <time class="fh2-date">
                                    {{ ($feedback->created_at ?? now())->format('Y-m-d') }}
                                </time>
                                <span class="fh2-lesson">{{ $feedback->lesson ?? '―' }}</span>
                            </div>
                        </header>

                        <div class="fh2-chips">
                            <span class="fh2-chip"><b>S</b>{{ $feedback->speaking ?? '―' }}</span>
                            <span class="fh2-chip"><b>L</b>{{ $feedback->listening ?? '―' }}</span>
                            <span class="fh2-chip"><b>R</b>{{ $feedback->reading ?? '―' }}</span>
                            <span class="fh2-chip"><b>W</b>{{ $feedback->writing ?? '―' }}</span>
                            <span class="fh2-chip"><b>G</b>{{ $feedback->grammar ?? '―' }}</span>
                        </div>

                        @if (!empty($feedback->comment))
                            <p class="fh2-cmt">“{{ $feedback->comment }}”</p>
                        @endif
                    </div>
                </article>
            @empty
                {{-- <p>No feedback has been provided yet.</p> --}}
                {{-- <p>No blog posts yet.</p> --}}
                <div class="post-card empty">
                    <div class="empty-inner">
                        <i class="fa-regular fa-file-lines fa-2x"></i>
                        <p>No feedback has been sent yet.</p>
                        {{-- 置きたいなら作成ボタンも --}}
                        {{-- <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">Write your first post</a> --}}
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
