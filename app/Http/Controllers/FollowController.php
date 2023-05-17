<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
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
}
