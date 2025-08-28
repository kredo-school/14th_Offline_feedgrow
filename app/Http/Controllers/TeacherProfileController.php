<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherProfileController extends Controller
{

    // 表示（閲覧用）
    public function show($id)
    {
        $user =  User::with('posts')->findOrFail($id);
        return view('teacher.profile.show', compact('user'));
    }

    // 編集画面
    public function edit()
    {
        return view('teacher.profile.edit', ['user' => Auth::user()]);
    }

    // 更新処理
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'introduction' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $path;
        }

        // $user = Auth::user();
        $user->update($data);

        // return redirect()->route('teacher.profile.edit');
       return redirect()
    ->route('teacher.profile.show', ['id' => $user->id])
    ->with('status', 'Profile updated successfully!');

    }
}
