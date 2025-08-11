@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <div class="notif-page">
        <div class="notif-header">
            <a href="{{ route('home') }}" class="back-btn-create back-btn-create--pill">
                <span class="chev">←</span> Back
            </a>
        </div>
        <div class="notif-card">
            <div class="notif-title">
                <i class="fa-regular fa-bell"></i>
                <span>NOTIFICATION</span>
            </div>

            <div class="notif-list">
                @forelse($notifications as $n)
                    @php
                        // 配列でもEloquentでも動くように吸収
                        $userName = data_get($n, 'user.name') ?? (data_get($n, 'user_name') ?? 'User');
                        $avatar =
                            data_get($n, 'user.avatar') ?? (data_get($n, 'avatar') ?? 'images/default-avatar.png');
                        $message = data_get($n, 'title') ?? (data_get($n, 'message') ?? 'New notification');
                        $createdAt = data_get($n, 'created_at');
                        if ($createdAt instanceof \Illuminate\Support\Carbon || $createdAt instanceof \Carbon\Carbon) {
                            $dateText = $createdAt->format('d/m/Y');
                        } else {
                            $dateText = \Illuminate\Support\Str::of($createdAt)->isNotEmpty()
                                ? $createdAt
                                : now()->format('d/m/Y');
                        }
                    @endphp

                    <div class="notif-item">
                        <div class="notif-left">
                            <img class="notif-avatar"
                                src="{{ Str::startsWith($avatar, ['http', 'https']) ? $avatar : asset($avatar) }}"
                                alt="avatar">
                            <div class="notif-texts">
                                <div class="notif-name">{{ $userName }}</div>
                                <div class="notif-msg">{{ $message }}</div>
                            </div>
                        </div>
                        <div class="notif-date">{{ $dateText }}</div>
                    </div>
                @empty
                    <div class="notif-empty">No notifications yet.</div>
                @endforelse
            </div>
        </div>

        {{-- ページネーション（配列の場合は表示しない） --}}
        {{-- @if (method_exists($notifications, 'links'))
    <div class="notif-pagination">
      {{ $notifications->onEachSide(1)->links('vendor.pagination.simple-default') }}
    </div>
  @endif --}}

    </div>
    {{-- <div class="notification-container">
        <div class="notification-header">
            <i class="fa fa-bell"></i>
            <h2>NOTIFICATION</h2>
        </div>
        <div class="notification-list">
            @foreach ($notifications as $n)
                <div class="notification-item">
                    <img src="{{ asset('images/daiki_icon.jpg') }}" class="avatar">
                    <div class="body">
                        <strong>{{ $n['user']['name'] }}</strong>
                        <p>{{ $n['title'] }}</p>
                    </div>
                    <span class="date">{{ $n['created_at'] }}</span>
                </div>
            @endforeach --}}

    {{-- @foreach ($notifications as $notification)
        <div class="notification-item">
            <img src="{{ asset('storage/' . $notification->user->avatar) }}" alt="avatar" class="avatar">
            <div class="notification-text">
                <strong>{{ $notification->user->name }}</strong>
                <p>{{ $notification->message }}</p>
            </div>
            <span class="notification-date">{{ $notification->created_at->format('d/m/Y') }}</span>
        </div>
        <hr>
        @endforeach --}}

    {{-- </div>

        <div class="pagination">
            {{-- {{ $notifications->links() }} --}}
    {{-- </div>
    </div> --}}
@endsection
