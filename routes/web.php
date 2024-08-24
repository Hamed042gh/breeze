<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Auth\SocialAuthController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('posts', [PostController::class, 'index'])->name('posts.index');

Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [AccountSettingsController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AccountSettingsController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AccountSettingsController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('auth/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('auth/{provider}/login', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');



Route::middleware('auth')->group(function () {
    Route::get('profile/posts/{id}', [UserProfileController::class, 'showUserPosts'])->name('profile.posts.show');
    Route::get('profile/posts/{post}/edit', [UserProfileController::class, 'editUserPosts'])->name('profile.posts.edit');
    Route::put('profile/posts/{post}/edit', [UserProfileController::class, 'updateUserPosts'])->name('profile.posts.update');
    Route::delete('profile/posts/{post}/delete', [UserProfileController::class, 'deleteUserPosts'])->name('profile.posts.delete');
});
