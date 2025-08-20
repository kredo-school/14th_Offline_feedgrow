<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="..." crossorigin="anonymous" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .bg-pink { background-color: #F53CF5 !important; }
        .dropdown-menu { margin-top: 15px !important; z-index: 1050; }
        .text-blue { color: #1D80E7; font-weight: bold; }
        .logo-fix { mix-blend-mode: multiply; filter: brightness(1.05) contrast(1.05); width: auto; }
    </style>
</head>
<body>
<div id="app">
    <!-- カスタムヘッダー -->
    <header class="navbar bg-white shadow-sm px-4 d-flex justify-content-between align-items-center" style="height:70px;">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/fg.png') }}" alt="FeedGrow" height="50" class="me-2 logo-fix">
        </div>

        <div class="d-flex align-items-center">
            @guest
                @if (Route::has('login'))
                    <a class="nav-link me-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else
                {{-- 通知ベル（生徒のみ） --}}
                @if (Auth::user()->role === 'student')
                    <div class="position-relative me-2 mt-1 dropdown">
                        <i class="fa-solid fa-bell fa-lg text-secondary"></i>
                        <a class="nav-link position-absolute top-0 start-0 w-100 h-100 p-0"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>

                        @php $unreads = Auth::user()->unreadNotifications->count(); @endphp
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-pink" style="font-size:10px;">
                            {{ $unreads > 99 ? '99+' : $unreads }}
                        </span>

                        {{-- ▼ 通知メニュー（相手のアイコン＋名前＋文面） --}}
                        <ul class="dropdown-menu dropdown-menu-end" style="min-width:320px;">
                            @forelse(Auth::user()->unreadNotifications->take(5) as $n)
                                @php
                                    $d      = $n->data ?? [];
                                    $name   = $d['actor'] ?? 'User';
                                    $avatar = $d['actor_avatar_url'] ?? asset('images/User-avatar.png');
                                    $type   = $d['type'] ?? null;
                                @endphp
                                <li>
                                    <a class="dropdown-item small py-2" href="{{ route('notifications.read', $n->id) }}">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ $avatar }}" alt="{{ $name }} avatar"
                                                 class="rounded-circle me-2 flex-shrink-0"
                                                 style="width:32px;height:32px;object-fit:cover;border:1px solid #888;"
                                                 onerror="this.onerror=null;this.src='{{ asset('images/User-avatar.png') }}';">
                                            <div class="min-w-0">
                                                <p class="mb-0 text-truncate">
                                                    <span class="fw-bold me-1">{{ $name }}</span>
                                                    @if($type === 'like')
                                                        liked your post.
                                                    @elseif($type === 'comment')
                                                        commented on your post.
                                                    @elseif($type === 'evaluation')
                                                        sent you an evaluation.
                                                    @else
                                                        {{ $d['message'] ?? 'There is a notification' }}
                                                    @endif
                                                </p>
                                                <small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @empty
                                <li><span class="dropdown-item small text-muted">No unread messages</span></li>
                            @endforelse

                            <li><a class="dropdown-item" href="{{ route('notifications.index') }}">View all notifications</a></li>
                        </ul>
                    </div>
                @endif

                {{-- 自分のプロフィールアイコン（ユーザー名の横） --}}
               <a href="{{ route('profile.show', Auth::id()) }}" class="d-flex align-items-center">
                    @if (!empty(Auth::user()->profile_image))
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="User Avatar"
                             class="rounded-circle me-2"
                             style="width:40px;height:40px;object-fit:cover;border:1px solid #888888;">
                    @else
                        <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                           style="width:40px;height:40px;font-size:18px;color:#c7cedc;border:1px solid #888888;"></i>
                    @endif
                </a>

                {{-- ユーザー名 & ログアウト --}}
                <div class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-secondary fw-bold ms-1 me-2"
                       href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-blue" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </header>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
