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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="..." crossorigin="anonymous" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .bg-pink {
            background-color: #f53cf5 !important;
        }

        .dropdown-menu {
            margin-top: 15px !important;
            /* ドロップダウンが少し下に開く */
            z-index: 1050;
            /* 他要素より前面に出す */
        }

        .text-blue {
            color: #1D80E7;
            font-weight: bold
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- ✅ カスタムヘッダー -->
        <header class="navbar bg-white shadow-sm px-4 d-flex justify-content-between align-items-center"
            style="height: 70px; border-bottom: 5px solid #1D80E7;">
            <div class="d-flex align-items-center">
                <!-- ロゴ画像 -->
                <img src="{{ asset('images/fg.png') }}" alt="FeedGrow" height="50" class="me-2">
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
                    <!-- 通知ベル -->
                    <div class="position-relative me-2 mt-1">
                        <i class="fa-solid fa-bell fa-lg text-secondary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-pink"
                            style="font-size: 10px;">
                            11
                        </span>
                    </div>

                    <!-- ユーザー画像 -->
                    <img src="{{ asset('images/daiki_icon.jpg') }}" alt="user" class="rounded-circle me-2 ms-4"
                        style="width: 40px; height: 40px;">

                    <!-- ユーザー名 & ログアウト -->
                    <div class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-secondary fw-bold ms-2 me-2"
                            href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" v-pre>
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
