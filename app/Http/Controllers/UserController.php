<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function posts(User $user)
    {
        $posts = $user->posts()->latest()->get();
        $postsCount = $user->posts()->count();

        return view('user.posts', ['user' => $user, 'postCount' => $postsCount, 'posts' => $posts]);
    }
}
