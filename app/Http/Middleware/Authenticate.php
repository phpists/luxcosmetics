<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (Str::contains(url()->previous(), 'cart'))
            return $request->expectsJson() ? null : route('cart.login');
        else
            return $request->expectsJson() ? null : route('login');
    }
}
