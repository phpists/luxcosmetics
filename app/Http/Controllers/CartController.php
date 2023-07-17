<?php

namespace App\Http\Controllers;

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

    public function login() {
        return view('cart.login');
    }

    public function delivery()
    {
        return view('cart.delivery');
    }

    public function store(Request $request)
    {
        dd($request->post());
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
