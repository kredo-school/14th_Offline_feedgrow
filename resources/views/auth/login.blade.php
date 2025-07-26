@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #1D80E7;
            /* 青背景 */
            color: white;
            height: 100vh;
            font-family: 'PT Sans', sans-serif;
            font-weight: 700;
        }

        .form-control::placeholder {
            color: #A0A0A0;
        }

        .logo {
            width: 300px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .form-label {
            color: white;
        }

        .btn-login {
            border: 2px solid #DCBF7D;
            color: white;
        }

        .btn-login:hover {
            background-color: #DCBF7D;
            color: #1D80E7;
        }

        a {
            color: #DCBF7D;
            text-decoration: none;
        }

        /* ４．共通：アイコンと入力欄を透過＆白字に */
        .login-input .input-group {
            background: transparent;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #fff;
        }

        .login-input .input-group-text,
        .login-input .form-control {
            background: transparent;
            border: none;
            color: #fff;
        }
    </style>
    <div class="container d-flex flex-column align-items-center justify-content-center h-100">
        <!-- ✅ ロゴ部分 -->
        <img src="{{ asset('images/feedgrow_logo.png') }}" alt="FeedGrow Logo" class="logo">

        <!-- ✅ 登録フォーム -->
        <div class="form-container text-center">
            <h1 class="mb-3 fw-bold">Login</h1>
            <p>Please enter your Email and your Password</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3 login-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-regular fa-user fa-lg"></i>
                        </span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3 login-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-solid fa-lock fa-lg"></i>
                        </span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login w-100">Login</button>

                <p class="text-center mt-3">
                    <span class="text-white">Not a member yet?</span>
                    <a href="{{ route('register') }}">
                        Register!
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
