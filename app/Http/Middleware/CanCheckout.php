<?php

namespace App\Http\Middleware;

use App\Services\CartService;
use App\Services\SiteConfigService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanCheckout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (CartService::canCheckout())
            return $next($request);

        return redirect('cart')->with('error', 'Минимальная сума заказа -'
            . SiteConfigService::getParamValue('min_checkout_sum'));
    }
}
