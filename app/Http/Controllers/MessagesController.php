<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessage;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        event(new ChatMessage(
            $request->input('textvalue')
        ));

        return true;
    }
}
