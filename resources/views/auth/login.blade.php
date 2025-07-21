@extends('layouts.app')

@section('content')
    <style>
        .login-page {
            position: absolute;
            top: 56px;
            /* Breeze の nav 高さに合わせる */
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* 縦方向中央揃え */
            align-items: center;
            /* 横方向中央揃え */
        }


        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #377dff;
        }


        .login-page {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }


        .login-box {
            max-width: 400px;
            width: 100%;
        }


        .login-input .input-group-text,
        .login-input .form-control {
            background: transparent;
            border: none;
            color: #fff;
        }


        .login-input .input-group {
            border: 2px solid #fff;
            border-radius: 50px;
            overflow: hidden;
        }


        .login-input .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }


        .login-btn {
            border-radius: 50px;
            border: 2px solid #f5c518;
        }

        .login-btn,
        .login-btn:hover {
            color: #fff;
        }
    </style>

    <div class="login-page">

        <h1 class="text-white fw-bold mb-3">Login</h1>
        <p class="text-white mb-4">Please enter your Email and your Password</p>

        <div class="login-box">
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


                <button type="submit" class="btn btn-outline-warning login-btn w-100 py-2 fw-bold mb-2">
                    Login
                </button>


                <p class="text-center mb-0">
                    <span class="text-white">Not a member yet?</span>
                    <a href="{{ route('register') }}" class="text-warning fw-semibold">Register!</a>
                </p>
            </form>
        </div>
    </div>
@endsection
