<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillEvaluationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BlogController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    //like
    Route::post('/posts/{id}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{id}/like', [LikeController::class, 'destroy'])->name('likes.destroy');

    //comment
    Route::post('/posts/{id}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])
        ->name('comments.edit');
    Route::post('/comments/{id}', [CommentController::class, 'update'])
        ->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    //Event
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('/event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}', [EventController::class, 'delete'])->name('event.delete');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    //feedback history
    Route::get('/feedbackhistory', [FeedbackController::class, 'index'])->name('feedbackhistory');

    Route::get('/blog/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::get('/blog/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blogs.show');

    Route::get('/teacher/evaluations/search', [SkillEvaluationController::class, 'searchForm'])->name('evaluations.search.form')->middleware('auth');
    Route::get('/teacher/evaluations/results', [SkillEvaluationController::class, 'searchResults'])->name('evaluations.search.results')->middleware('auth');
    Route::get('/teacher/evaluations/{student}/create', [SkillEvaluationController::class, 'create'])->name('evaluations.create')->middleware('auth');
});
