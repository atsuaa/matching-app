<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::post('/blog/search', [BlogController::class, 'search'])->name('blog.search');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::patch('/blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}/destroy', [BlogController::class, 'destroy'])->name('blog.destroy');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/search', [UserController::class, 'search'])->name('user.search');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/favorite/{id}', [UserController::class, 'favorite'])->name('user.favorite');

    Route::get('/thread', [ThreadController::class, 'index'])->name('thread.index');
    Route::get('/thread/store/{id}', [ThreadController::class, 'store'])->name('thread.store');

    Route::get('/message/{thread_id}', [MessageController::class, 'index'])->name('message.index');
    Route::post('/message/{thread_id}/store', [MessageController::class, 'store'])->name('message.store');
});

require __DIR__ . '/auth.php';
