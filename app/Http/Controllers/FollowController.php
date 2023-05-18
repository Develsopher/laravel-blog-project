<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FollowController extends Controller
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

    public function follow(User $user)
    {
        // you cannot follow yourself
        if($user->id === auth()->user()->id){
            return back()->with('failure', 'You cannot follow yourself :<');
        }
        // you cannot anyone you alreay followed
        $existCheck = Follow::where([
            ['user_id', '=', auth()->user()->id],
            ['followedUser', '=', $user->id]
        ])->count();
        if ($existCheck) {
            return back()->with('failure', 'You already followed this guy');
        }

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followedUser = $user->id;
        $newFollow->save();

        return back()->with('success', 'You followed this guy successfully');
    }

    public function unfollow(User $user)
    {
        Follow::where([['user_id', '=', auth()->user()->id], ['followedUser', '=', $user->id]])->delete();

        return back()->with('success', 'You unfollowed this guy successfully');
    }

    public function followers(User $user)
    {
        $this->getUserData($user);

        return view('user.followers');
    }

    public function followings(User $user)
    {
        $this->getUserData($user);

        return view('user.followings');
    }
}
