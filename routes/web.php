<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

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

    Route::get('/tasks/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/',[TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}/edit/',[TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
});
