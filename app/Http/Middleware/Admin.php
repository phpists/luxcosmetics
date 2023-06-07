<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && User::ADMIN == Auth::user()->role_id)
        {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
