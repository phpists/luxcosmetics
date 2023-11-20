<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderPaymentService;
use Illuminate\Http\Request;

class PaykeeperController extends Controller
{

    public function index(Request $request)
    {
        try {
            $order = Order::where('num', $request->post('orderid'))->first();

            $orderPaymentService = new OrderPaymentService($order);
            if (!$orderPaymentService->confirmPayment())
                throw new \Exception('Failed to confirm payment');

            $hash = md5($request->post('id') . config('paykeeper.secret'));
            return "OK {$hash}";
        } catch (\Exception $exception) {
            return "ERROR: {$exception->getMessage()}";
        }
    }

}
