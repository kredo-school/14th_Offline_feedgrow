{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit profile</h1>

    {{-- 成功メッセージ --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 名前 --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
            @error('email')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border rounded p-2 @error('password') border-red-500 @enderror">
            @error('password')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード確認 --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded p-2">
        </div>

        {{-- 自己紹介 --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Introduction</label>
            <textarea name="introduction" rows="4"
                      class="w-full border rounded p-2 @error('introduction') border-red-500 @enderror">{{ old('introduction', $user->introduction) }}</textarea>
            @error('introduction')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- プロフィール画像 --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Profile Image</label>
            <input type="file" name="profile_image"
                   class="border rounded p-1 @error('profile_image') border-red-500 @enderror">
            @error('profile_image')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- ボタン --}}
        <div class="flex space-x-2">
            <a href="{{ url()->previous() }}"
               class="px-4 py-2 bg-gray-300 rounded">← BACK</a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded">SAVE</button>
        </div>
    </form>
</div>
@endsection
