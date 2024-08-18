<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

 Route::get('/', function () {
    return redirect()->route('posts.index');
 });
 Route::resource('/posts', PostController::class)
 ->middleware('auth')
  ->except(['index', 'show']);
 Route::resource('posts', PostController::class)
     ->only(['index', 'show']);
//  Route::get('/posts', [PostController::class, 'index'])->name('posts.show');
//  Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//  Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





// Route::resource('posts', PostController::class)
//     ->only(['index', 'show']);
// Route::resource('profile', ProfileController::class)
//     ->middleware('auth')
//     ->except(['index', 'show']);


// Route::resource('profile', ProfileController::class)
//     ->only(['index', 'show']);