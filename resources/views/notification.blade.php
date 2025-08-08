@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/notification.css') }}">

<div class="notification-container">
    <div class="notification-header">
        <i class="fa fa-bell"></i>
        <h2>NOTIFICATION</h2>
    </div>
    <div class="notification-list">
        @foreach($notifications as $notification)
        <div class="notification-item">
            <img src="{{ asset('storage/' . $notification->user->avatar) }}" alt="avatar" class="avatar">
            <div class="notification-text">
                <strong>{{ $notification->user->name }}</strong>
                <p>{{ $notification->message }}</p>
            </div>
            <span class="notification-date">{{ $notification->created_at->format('d/m/Y') }}</span>
        </div>
        <hr>
        @endforeach
    </div>

    <div class="pagination">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
