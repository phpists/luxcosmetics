<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePromotionRequest;
use App\Http\Requests\Admin\UpdatePromotionRequest;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Promotion::class);
    }

    public function index()
    {
        return view('admin.promotions.index', [
            'promotions' => Promotion::paginate(),
        ]);
    }

    public function store(StorePromotionRequest $request)
    {
        $data = $request->validated();
        $data['preview_img'] = $request->handleFile('preview_img');
        $data['bg_img'] = $request->handleFile('bg_img');

        try {
            $promotion = Promotion::create($data);

            return Response::json([
                'redirect_url' => route('admin.promotions.edit', $promotion)
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }

    public function updateStatus(Request $request, Promotion $promotion)
    {
        $this->authorize('update', $promotion);

        $promotion->update([
            'is_active' => $request->boolean('is_active'),
        ]);
    }

    public function edit(Promotion $promotion)
    {
        $allProducts = Product::whereNotIn('id', $promotion->products->pluck('id'))->get();

        return view('admin.promotions.edit', [
            'promotion' => $promotion,
            'propertyTitles' => PromotionProperty::pluck('title')->unique(),
            'allProducts' => $allProducts
        ]);
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $data = $request->validated();
        $data['preview_img'] = $request->handleFile('preview_img', $promotion);
        $data['bg_img'] = $request->handleFile('bg_img', $promotion);

        try {
            if ($promotion->update($data))
                return Response::json(['message' => 'Изменения сохранены']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }

    public function updateSeo(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $data = $request->validated();
        $data['preview_img'] = $request->handleFile('preview_img', $promotion);
        $data['bg_img'] = $request->handleFile('bg_img', $promotion);

        try {
            if ($promotion->update($data))
                return Response::json(['message' => 'Изменения сохранены']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }

    public function destroy(Request $request, Promotion $promotion)
    {
        if ($promotion->delete())
            return to_route('admin.promotions.index')->with('success', 'Акция успешно удалена');

        return to_route('admin.promotions.index')->with('error', 'ОШИБКА');
    }
}
