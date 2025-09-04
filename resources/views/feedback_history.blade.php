@extends('layouts.app')

@section('title', 'Feedback History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/feedback_history.css') }}">

<div class="main-section">
  <div class="feedback-header">
    <a href="{{ route('student.home') }}" class="back-btn back-btn--pill">
      <span class="chev">←</span> Back
    </a>
    <h1 class="page-title fw-bold">FEEDBACK HISTORY</h1>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card-container">
    @forelse ($feedbacks as $feedback)
      <div class="feedback-card">
        <div class="profile">
    @if (!empty($feedback->teacher->profile_image))
        <img src="{{ asset('storage/' . $feedback->teacher->profile_image) }}"
             alt="{{ $feedback->teacher->name ?? 'Teacher' }}"
             class="avatar">
    @else
        <i class="fa-solid fa-user fa-2x avatar" style="color:#c7cedc;"></i>
    @endif
    <span>{{ $feedback->teacher->name ?? 'Teacher' }}</span>
</div>

        <div class="date small">
         {{ $feedback->created_at->format('Y-m-d') }}
        </div>

        <div class="lesson">
          <small>Lesson:</small> {{ $feedback->lesson ?? '―' }}
        </div>

        <ul class="scores">
          <li><span class="small">Speaking:</span>  {{ $feedback->speaking  ?? '―' }}</li>
          <li><span class="small">Listening:</span> {{ $feedback->listening ?? '―' }}</li>
          <li><span class="small">Reading:</span>   {{ $feedback->reading  ?? '―' }}</li>
          <li><span class="small">Writing:</span>   {{ $feedback->writing  ?? '―' }}</li>
          <li><span class="small">Grammar:</span>   {{ $feedback->grammar  ?? '―' }}</li>
        </ul>

        @if (!empty($feedback->comment))
          <div class="comment">
            <small>Comment:</small> {{ $feedback->comment }}
          </div>
        @endif
      </div>
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
