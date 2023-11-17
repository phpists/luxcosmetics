<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Auth::user()->orders()->orderBy('id', 'DESC')->paginate();

        if ($request->ajax() && $request->wantsJson()) {
            return new JsonResponse([
                'html' => view('cabinet.orders._list', compact('orders'))->render()
            ]);
        }

        return view('cabinet.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('cabinet.orders.show', compact('order'));
    }

    public function repeat(Order $order)
    {
        $cartService = new CartService();
        $cartService->clear();

        foreach (CartService::ALL_KEYS as $name => $title)
            $cartService->setProperty($name, $order->$name);

        foreach ($order->orderProducts as $orderProduct)
            $cartService->add($orderProduct->product_id, $orderProduct->quantity);

        return redirect()->route('cart');
    }

    public function payment(Order $order)
    {
        $orderPaymentService = new OrderPaymentService($order);

        return view('orders.payment', [
            'form' => $orderPaymentService->renderForm()
        ]);
    }

}
