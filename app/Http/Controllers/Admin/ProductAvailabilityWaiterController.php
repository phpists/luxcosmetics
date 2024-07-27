<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAvailabilityWaiter;
use Illuminate\Http\Request;

class ProductAvailabilityWaiterController extends Controller
{

    public function index()
    {
        $productId = \request('product_id');
        $productAvailabilityWaiters = ProductAvailabilityWaiter::when($productId, function ($query) use ($productId) {
                return $query->where('product_id', $productId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate();

        $products = Product::whereIn(
                'id',
                ProductAvailabilityWaiter::groupBy('product_id')->pluck('product_id')->toArray()
            )
            ->get();

        return view('admin.product-availability-waiter.index', compact('productAvailabilityWaiters', 'products'));
    }

}
