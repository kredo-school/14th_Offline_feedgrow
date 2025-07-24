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

        .btn-register {
            border: 2px solid #DCBF7D;
            color: white;
        }

        .btn-register:hover {
            background-color: #DCBF7D;
            color: #1D80E7;
        }

        a {
            color: #DCBF7D;
            text-decoration: none;
        }

        /* ４．共通：アイコンと入力欄を透過＆白字に */
        .auth-input .input-group {
            background: transparent;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #fff;
        }

        .auth-input .input-group-text,
        .auth-input .form-control {
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
            <h1 class="mb-3 fw-bold">Register</h1>
            <p>Please enter your Name, Login and your Password</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                {{-- Role --}}
                <div class="mb-3 auth-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-regular fa-user fa-lg"></i>
                        </span>
                        <select id="role" name="role" required
                            class="form-control @error('role') is-invalid @enderror">
                            <option value="">
                                User purpose</option>
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                        </select>
                    </div>
                    @error('role')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Username --}}
                <div class="mb-3 auth-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-regular fa-user fa-lg"></i>
                        </span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autocomplete="name" autofocus placeholder="Username"
                            class="form-control @error('name') is-invalid @enderror">
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Email --}}
                <div class="mb-3 auth-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-regular fa-envelope fa-lg"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Password --}}
                <div class="mb-3 auth-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-solid fa-lock fa-lg"></i>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Confirm Password --}}
                <div class="mb-4 auth-input">
                    <div class="input-group align-items-center">
                        <span class="input-group-text px-3">
                            <i class="fa-solid fa-lock fa-lg"></i>
                        </span>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Re-enter Password" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-register w-100">Register</button>
                <p class="text-center mt-3">
                    <span class="text-white">Already have an Account?</span>
                    <a href="{{ route('login') }}">
                        Login!
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
