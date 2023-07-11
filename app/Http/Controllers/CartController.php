<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(private CartService $cartService)
    {}


    public function index() {
        $cart_products = $this->cartService->getAllProducts();

        return view('cart.index', compact('cart_products'));
    }

    public function step_first() {
        return view('cart.pay-step1');
    }

    public function step_second() {
        return view('cart.pay-step2');
    }

    public function add(Request $request)
    {
        $this->cartService->add($request->post('product_id'), $request->post('property_id'));
        $total_count = $this->cartService->getTotalCount();

        return response()->json([
            'total_count' => $total_count
        ]);
    }

    public function remove(Request $request)
    {
        $this->cartService->remove($request->post('product_id'), $request->post('property_id'));
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'total_count' => $total_count,
            'total_sum' => $total_sum
        ]);
    }

    public function plusQuantity(Request $request)
    {
        $quantity = $this->cartService->plusQuantity($request->post('product_id'), $request->post('property_id'));
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'quantity' => $quantity,
            'total_count' => $total_count,
            'total_sum' => $total_sum
        ]);
    }

    public function minusQuantity(Request $request)
    {
        $quantity = $this->cartService->minusQuantity($request->post('product_id'), $request->post('property_id'));
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'quantity' => $quantity,
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
