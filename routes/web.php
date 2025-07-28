<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/student/home', function () {
        return view('home');
    })->name('student.home');

    Route::get('/teacher/home', function () {
        return view('teacher');
    })->name('teacher.home');

    //task
    // Route::get('/tasks/', [TaskController::class, 'index'])->name('tasks.index');
    // Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    // Route::post('/tasks/',[TaskController::class, 'store'])->name('tasks.store');
    // Route::get('/tasks/{id}/edit/',[TaskController::class, 'edit'])->name('tasks.edit');
    // Route::post('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');


    //post
    Route::get('/posts/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit/', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    //like
    Route::post('/posts/{id}/like',[LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{id}/like',[LikeController::class, 'destroy'])->name('likes.destroy');
});
