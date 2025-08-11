@extends('layouts.app')

@section('title', 'Feedback History')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/feedback_history.css') }}">

    <div class="main-section">

        <div class="feedback-header">
            <a href="{{ route('home') }}" class="back-btn back-btn--pill">
                <span class="chev">←</span> Back
            </a>
            <h1 class="page-title fw-bold">FEEDBACK HISTORY</h1>
        </div>
        <div class="card-container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-container">
            @forelse($feedbacks as $feedback)
                <div class="feedback-card">
                    <div class="profile">
                        <img src="{{ asset('images/' . optional($feedback->teacher)->avatar) }}"
                            alt="{{ optional($feedback->teacher)->name }}" class="avatar">
                        <span>{{ optional($feedback->teacher)->name }}</span>
                    </div>
                    <div class="date small">
                        {{ $feedback->created_at->format('Y年n月j日 H:i') }}
                    </div>
                    <div class="lesson">
                        <small>Lesson:</small>{{ $feedback->comment ?? '―' }}
                    </div>
                    <ul class="scores">
                        <li><span class="small">Speaking:</span> {{ $feedback->speaking ?? '―' }}</li>
                        <li><span class="small">Listening:</span> {{ $feedback->listening ?? '―' }}</li>
                        <li><span class="small">Reading:</span> {{ $feedback->reading ?? '―' }}</li>
                        <li><span class="small">Writing:</span> {{ $feedback->writing ?? '―' }}</li>
                        <li><span class="small">Grammar:</span> {{ $feedback->grammar ?? '―' }}</li>
                    </ul>
                </div>
            @empty
                <p>No feedback has been provided yet.</p>
            @endforelse
        </div>
    </div>
@endsection
