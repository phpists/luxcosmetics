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
        $order = Order::find($request->post('orderid'));
        $orderPaymentService = new OrderPaymentService($order);

        try {
            $orderPaymentService->confirmPayment();

            $hash = md5($request->post('id') . config('paykeeper.secret'));
            return "OK {$hash}";
        } catch (\Exception $exception) {
            return "ERROR: {$exception->getMessage()}";
        }
    }

}
