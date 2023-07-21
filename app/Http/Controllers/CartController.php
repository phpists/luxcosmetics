<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends Controller
{

    public function __construct(private CartService $cartService)
    {}


    public function index() {
        $cart_products = $this->cartService->getAllProducts();

        return view('cart.index', compact('cart_products'));
    }

    public function indexStore(Request $request)
    {
        $gift_box = $request->boolean(CartService::GIFT_BOX_KEY);
        $this->cartService->setProperty(CartService::GIFT_BOX_KEY, $gift_box);

        return redirect()->route('cart.delivery');
    }

    public function login() {
        return view('cart.login');
    }

    public function delivery()
    {
        return view('cart.delivery');
    }

    public function deliveryStore(Request $request)
    {
        $delivery_type = $request->post(CartService::DELIVERY_KEY);
        $this->cartService->setProperty(CartService::DELIVERY_KEY, $delivery_type);

        $address_id = $request->post(CartService::ADDRESS_KEY);
        $this->cartService->setProperty(CartService::ADDRESS_KEY, $address_id);

        return redirect()->route('cart.payment');
    }

    public function payment()
    {
        $address = Address::findOrFail($this->cartService->getProperty(CartService::ADDRESS_KEY));

        return view('cart.payment', compact('address'));
    }

    public function checkoutStore(Request $request)
    {
        $as_delivery_address = $request->boolean('as_delivery_address');
        $this->cartService->setProperty(CartService::AS_DELIVERY_ADDRESS_KEY, $as_delivery_address);
        $card_id = $request->post('card_id');
        $this->cartService->setProperty(CartService::CARD_KEY, $card_id);

        if ($order_id = $this->cartService->store())
            return redirect()->route('cart.success', ['order' => $order_id]);

        return redirect()->route('cart.error');
    }

    public function success(Order $order)
    {
        return view('cart.success', compact('order'));
    }

    public function error()
    {
        return view('cart.error');
    }


    public function add(Request $request)
    {
        $this->cartService->add($request->post('product_id'));
        $total_count = $this->cartService->getTotalCount();

        return response()->json([
            'total_count' => $total_count,
            'product_html' => view('layouts.includes._purchase_modal_product', [
                'product' => Product::find($request->post('product_id'))
            ])->render()
        ]);
    }

    public function remove(Request $request)
    {
        $this->cartService->remove($request->post('product_id'));
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'total_count' => $total_count,
            'total_sum' => $total_sum
        ]);
    }

    public function plusQuantity(Request $request)
    {
        $quantity = $this->cartService->plusQuantity($request->post('product_id'));
        $sum = round((Product::find($request->post('product_id')))->price * $quantity, 2);
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'quantity' => $quantity,
            'sum' => $sum,
            'total_count' => $total_count,
            'total_sum' => $total_sum
        ]);
    }

    public function minusQuantity(Request $request)
    {
        $quantity = $this->cartService->minusQuantity($request->post('product_id'));
        $sum = round((Product::find($request->post('product_id')))->price * $quantity, 2);
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'quantity' => $quantity,
            'sum' => $sum,
            'total_count' => $total_count,
            'total_sum' => $total_sum
        ]);
    }

    public function clear()
    {
        $this->cartService->clear();

        return back();
    }

}
