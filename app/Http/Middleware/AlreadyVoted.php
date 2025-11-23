<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AlreadyVoted
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->has_voted) {
            return redirect()->route('voting.thanks');
        }

        return $next($request);
    }
}
