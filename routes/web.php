<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'index'])->name('home');
Route::post('/signup', [LoginController::class, 'signup'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/test', [LoginController::class, 'test'])->middleware('mustlogin');

Route::get('/post/create', [PostsController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/post/store', [PostsController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('/post/{post}', [PostsController::class, 'show'])->name('post.show');
Route::put('/post/{post}', [PostsController::class, 'update'])->middleware('can:update,post');
Route::delete('/post/{post}', [PostsController::class, 'delete'])->middleware('can:delete,post');

Route::get('/{user:name}/posts', [UserController::class, 'posts'])->name('user.posts')->middleware('auth');
