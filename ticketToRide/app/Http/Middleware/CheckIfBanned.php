<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfBanned
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_banned) {
            auth()->logout(); 
            return redirect()->route('welcome')->with('error', 'You are banned'); // Redirect to a page indicating the user is banned
        }
        return $next($request);
    }
}
