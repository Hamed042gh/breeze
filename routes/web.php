<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile1Controller;

Route::get('/', function () {
    return redirect()->route('posts.index');
});
Route::get('posts', [PostController::class, 'index'])->name('posts.index');

Route::middleware('auth')->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';




// Route::get('profile/post', [Profile1Controller::class, 'edit'])->name('profile.post.edit');
Route::get('profile/post/{id}', [Profile1Controller::class, 'show'])->name('profile.post.show');

// Route::resource('profile', ProfileController::class)
//     ->middleware('auth')
//     ->except(['index', 'show']);


// Route::resource('profile', ProfileController::class)
//     ->only(['index', 'show']);