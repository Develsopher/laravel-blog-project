<?php

use App\Events\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowController;

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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');
Route::get('/feed', [HomeController::class, 'feed'])->name('feed')->middleware('auth');

Route::post('/signup', [LoginController::class, 'signup'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/test', [LoginController::class, 'test'])->middleware('mustlogin');
// 관리자 전용페이지
Route::get('/admin', [LoginController::class, 'admin'])->name('admin')->middleware('can:onlyAdmin');

// About Posting
Route::get('/post/create', [PostsController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/post/store', [PostsController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('/post/{post}', [PostsController::class, 'show'])->name('post.show');
Route::put('/post/{post}', [PostsController::class, 'update'])->middleware('can:update,post');
Route::delete('/post/{post}', [PostsController::class, 'delete'])->middleware('can:delete,post');

// About User
Route::get('/{user:name}/posts', [UserController::class, 'posts'])->name('user.posts')->middleware('auth');
Route::get('/users/manageAvatar', [UserController::class, 'manageAvatar'])->name('user.avatar')->middleware('auth');
Route::post('/users/uploadAvatar', [UserController::class, 'uploadAvatar'])->name('user.avatar.upload')->middleware('auth');

// Follow
Route::post('/follow/{user:name}', [FollowController::class, 'follow'])->name('follow')->middleware('auth');
Route::post('/unfollow/{user:name}', [FollowController::class, 'unfollow'])->name('unfollow')->middleware('auth');
Route::get('/{user:name}/followers', [FollowController::class, 'followers'])->name('followers')->middleware('auth');
Route::get('/{user:name}/followings', [FollowController::class, 'followings'])->name('followings')->middleware('auth');


// search
Route::get('/search/{term}', [PostsController::class, 'search']);

// Chat
Route::post('/send-chat-message', function (Request $request) {
    $formFields = $request->validate([
        'textvalue' => 'required'
    ]);

    if (!trim(strip_tags($formFields['textvalue']))) {
        return response()->noContent();
    }

    broadcast(new ChatMessage(['username' => auth()->user()->name, 'textvalue' => strip_tags($request->textvalue), 'avatar' => auth()->user()->avatar]))->toOthers();

    return true;
})->middleware('auth');
