<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePromotionProductRequest;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PromotionProductController extends Controller
{
    public function index(Promotion $promotion)
    {
        $allProducts = Product::whereNotIn('id', $promotion->products->pluck('id'))->get();
        return view('admin.promotions._products', [
            'promotion' => $promotion,
            'products' => $promotion->products,
            'allProducts' => $allProducts
        ]);
    }

    public function store(StorePromotionProductRequest $request, Promotion $promotion)
    {
        try {
            $productId = $request->input('product_id');
            $promotion->products()->attach($productId);

            return Response::json([
                'message' => 'Товар добавлен'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }

    public function destroy(Promotion $promotion, Product $product)
    {
        try {
            $promotion->products()->detach($product->id);

            return Response::json([
                'message' => 'Товар удален'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }

    public function updatePositions(Request $request, Promotion $promotion)
    {
        $positions = $request->post('positions', []);
        $promotion->products()->sync($positions);
    }
}
