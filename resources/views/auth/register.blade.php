@extends('layouts.app')

@section('content')
    <style>
        /* １．ページ全体背景を青に、ナビは白のまま */
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #377dff;
        }

        /* ２．フォーム部分だけをナビ下から中央に配置 */
        .register-page {
            position: absolute;
            top: 56px;
            /* Breeze の nav 高さ */
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* 縦中央 */
            align-items: center;
            /* 横中央 */
            text-align: center;
        }

        /* ３．フォーム幅の制限 */
        .register-box {
            max-width: 400px;
            width: 100%;
        }

        /* ４．共通：アイコンと入力欄を透過＆白字に */
        .auth-input .input-group-text,
        .auth-input .form-control {
            background: transparent;
            border: none;
            color: #fff;
        }

        /* ５．共通：丸枠スタイル */
        .auth-input .input-group {
            border: 2px solid #fff;
            border-radius: 50px;
            overflow: hidden;
        }

        /* ６．プレースホルダー半透明 */
        .auth-input .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        /* ７．ボタンの丸枠 */
        .auth-btn {
            border-radius: 50px;
            border: 2px solid #f5c518;
        }

        .auth-btn,
        .auth-btn:hover {
            color: #fff;
        }
    </style>

    <div class="register-page">
        {{-- タイトル --}}
        <h1 class="text-white fw-bold mb-3">Register</h1>
        <p class="text-white mb-4">
            Please enter your Name, Login and your Password
        </p>

        <div class="register-box">
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

                {{-- Register ボタン --}}
                <button type="submit" class="btn btn-outline-warning auth-btn w-100 py-2 fw-bold mb-2">
                    Register
                </button>

                {{-- ログインリンク --}}
                <p class="text-center mb-0">
                    <span class="text-white">Already have an Account?</span>
                    <a href="{{ route('login') }}" class="text-warning fw-semibold">
                        Login!
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
