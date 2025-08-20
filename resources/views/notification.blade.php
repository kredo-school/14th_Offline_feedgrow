@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/notification.css') }}">

<div class="notification-container">
  <div class="notification-header">
    <i class="fa fa-bell"></i>
    <h2>NOTIFICATION</h2>
  </div>

  <div class="notification-list">
    @forelse($notifications as $n)
      @php
        $data = $n->data ?? [];
        $actorName = $data['actor'] ?? 'ユーザー';
        $avatarUrl = $data['actor_avatar_url'] ?? asset('images/default-avatar.png');
        $message   = $data['message'] ?? '通知があります';
        $jumpUrl   = route('notifications.read', $n->id); // 既読にして遷移
      @endphp

      <a href="{{ $jumpUrl }}" class="notification-item d-flex align-items-center text-decoration-none">
        <img class="blog-avatar new rounded-circle me-2"
     src="{{ $avatarUrl }}"
     alt="{{ $actorName }} アイコン"
     loading="lazy"
     style="width:36px;height:36px;object-fit:cover;"
     onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}';">
          <strong>{{ $actorName }}</strong>
          <p class="mb-0">{{ $message }}</p>
        </div>
        <span class="notification-date text-muted">
          {{ $n->created_at->format('Y/m/d H:i') }}
        </span>
      </a>
      <hr>
    @empty
      <p class="text-muted">No notifications.</p>
    @endforelse
  </div>

  <div class="pagination">
    {{ $notifications->links() }}
  </div>
</div>
@endsection
