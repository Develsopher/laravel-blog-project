<?php

namespace App\Http\Controllers;

use App\Events\OurExampleEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 화면구성
    // Before Login : Loign & Sign Up.
    // After Login : NavBar & Feed i did follow.

    public function signup(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/')->with('success', 'Thank you for creating an account <3');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();
            // event(new OurExampleEvent(['username' => auth()->user()->name, 'action' => 'login']));
            event(new OurExampleEvent(['username' => auth()->user()->name, 'action' => 'login']));
            $user = User::where('email', $incomingFields['email'])->first();
            if($user->isAdmin === 1) {
                return redirect('/admin');
            }else {
                return redirect('/feed')->with('success', 'You have successfully logged in.');
            }
        } else {
            return redirect('/')->with('failure', 'Invalid Login.');
        }
    }

    public function logout()
    {
        event(new OurExampleEvent(['username' => auth()->user()->name, 'action' => 'logout']));
        auth()->logout();

        return redirect('/')->with('success', 'You have successfully logged out.');
    }

    public function test()
    {
        return 'test 페이지 입니다.';
    }

    public function admin()
    {
        return view('home.admin');
    }
}
