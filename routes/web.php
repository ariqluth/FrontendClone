<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LoginController::class, 'index'])->name('login.index');

Route::post('/login', [LoginController::class, 'login'])->name('login.create');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password.index');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password.post');

Route::get('/beranda', [PostController::class, 'index'])->name('post.index');

Route::get('/post-create', [PostController::class, 'create'])->name('post.create');

Route::post('/post-posting', [PostController::class, 'posting'])->name('post.posting');

Route::delete('/post-delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/post-show/{post}', [PostController::class, 'show'])->name('post.show');

Route::post('/post-update/{post}', [PostController::class, 'update'])->name('post.update');

Route::get('/stories', [StoryController::class, 'index'])->name('story.index');

Route::get('/stories/{userId', [StoryController::class, 'show'])->name('story.show');

Route::post('/stories', [StoryController::class, 'store'])->name('story.store');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('/like/{post?}', [LikeController::class, 'index'])->name('like.index');

Route::post('/like/{post}', [LikeController::class, 'store'])->name('like.store');

Route::delete('/like/{post}', [LikeController::class, 'destroy'])->name('like.destroy');
