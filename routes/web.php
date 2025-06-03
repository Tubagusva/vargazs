<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SaveController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('my-profile');

Route::get('/post', [PostController::class, 'create'])->middleware(['auth'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->middleware(['auth'])->name('post.store');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/posts/{id}/save', [PostController::class, 'save'])->name('posts.save');
Route::get('/saved', [PostController::class, 'saved'])->name('post.saved');

Route::delete('/unsave/{id}', [SaveController::class, 'destroy'])->name('unsave');
Route::view('/explore', 'explore')->name('explore');
Route::view('/notifications', 'notification')->name('notifications');

Route::resource('posts', PostController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
