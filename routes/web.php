<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\UserProfileController;

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
    Route::get('/profile', [AccountSettingsController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AccountSettingsController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AccountSettingsController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';




// Route::get('profile/post', [Profile1Controller::class, 'edit'])->name('profile.post.edit');
Route::get('profile/post/{id}', [UserProfileController::class, 'showUserPosts'])->name('profile.post.show');

// Route::resource('profile', ProfileController::class)
//     ->middleware('auth')
//     ->except(['index', 'show']);


// Route::resource('profile', ProfileController::class)
//     ->only(['index', 'show']);