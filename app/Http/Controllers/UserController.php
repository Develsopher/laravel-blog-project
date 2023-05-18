<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private function getUserData($user)
    {
        $isFollowing = 0;
        // 내가 특정 상대를 팔로잉하고 있는가?
        if(auth()->check()) {
            $isFollowing = Follow::where([
                'user_id' => auth()->user()->id,
                'followedUser' => $user->id
            ])->count();
        }

        $posts = $user->posts()->latest()->get();
        $postCount = $user->posts()->count();

        View::share('userData', compact(['user', 'posts', 'postCount', 'isFollowing']));
    }

    public function posts(User $user)
    {
        $this->getUserData($user);

        return view('user.posts');
    }

    public function manageAvatar(User $user)
    {
        return view('user.avatar', ['user' => $user]);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:3000'
        ]);

        $user = auth()->user();

        $filename = $user->id . '-' . uniqid() . '.jpg';

        $imgData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('public/avatars/' . $filename, $imgData);

        $user->avatar = $filename;
        $user->save();

        return redirect()->route('user.avatar')->with('success', 'You changed profile photo successfully :)');
    }
}
