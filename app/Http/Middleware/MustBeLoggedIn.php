<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustBeLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            return $next($request);
        } else {
            return redirect('/')->with('failure', 'MustBeLoggedIn 미들웨어에 의해 팅겼습니다.');
        }
    }
}
