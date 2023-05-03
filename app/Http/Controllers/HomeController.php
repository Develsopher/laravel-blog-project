<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $myName = 'June';
        $fruits = ['apple', 'banana', 'carrot'];

        return view('home', ['name' => $myName, 'fruits' => $fruits]);
    }
}
