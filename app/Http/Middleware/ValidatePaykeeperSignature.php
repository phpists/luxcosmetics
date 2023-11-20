<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidatePaykeeperSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->post('key');

        $id = $request->post('id');
        $sum = number_format($request->post('sum'), 2, ".", "");
        $client_name = $request->post('clientid');
        $order_num = $request->post('orderid');

        $order = Order::where('num', $order_num)->first();
        if (!$order)
            abort(400);

        if ($sum !== $order->total_sum || $client_name !== $order->full_name)
            abort(400);

        if ($key !== md5($id . $sum . $client_name . $order_num . config('paykeeper.secret')))
            abort(400);

        return $next($request);
    }
}
