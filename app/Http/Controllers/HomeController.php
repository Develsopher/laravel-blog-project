<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function feed()
    {
        $myPosts = auth()->user()->posts;
        $followingPosts = auth()->user()->feedPosts;
        $feeds = $myPosts->merge($followingPosts)->sortByDesc('created_at')->paginate(3);

        return view('home.feed', ['feeds' => $feeds]);
    }
}
