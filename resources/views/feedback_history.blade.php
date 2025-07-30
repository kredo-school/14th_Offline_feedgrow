@extends('layouts.app')

@section('title', 'Feedback History')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/feedback_history.css') }}">
    <div class="main-section">
        <h1 class="page-title fw-bold">FEEDBACK HISTORY</h1>
        <div class="card-container">

            @foreach ($feedbacks as $feedback)
                <div class="feedback-card">
                    <div class="profile">
                        <img src="{{ asset('images/' . $feedback['user']['avatar']) }}" alt="{{ $feedback['user']['name'] }}"
                            class="avatar">
                        <span>{{ $feedback['user']['name'] }}</span>
                    </div>
                    <div class="date small">{{ $feedback['date'] }}</div>
                    <div class="lesson">
                        <small>Lesson:</small> {{ $feedback['lesson'] }}</div>
                    <ul class="scores">
                        <li class="my-2"><span class="small">Speaking:</span> {{ $feedback['speaking'] }}</li>
                        <li class="my-2"><span class="small">Listening:</span> {{ $feedback['listening'] }}</li>
                        <li class="my-2"><span class="small">Writing:</span> {{ $feedback['writing'] }}</li>
                        <li class="my-2"><span class="small">Reading:</span> {{ $feedback['reading'] }}</li>
                        <li class="mt-2"><span class="small">Grammar:</span> {{ $feedback['grammar'] }}</li>
                    </ul>
                </div>
            @endforeach

        </div>
    </div>
@endsection
