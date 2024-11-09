<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePromotionPropertyRequest;
use App\Models\Promotion;
use App\Models\PromotionProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PromotionPropertyController extends Controller
{
    public function index(Promotion $promotion)
    {
        return view('admin.promotions._properties', [
            'properties' => $promotion->properties
        ]);
    }

    public function getValues(Request $request)
    {
        $values = PromotionProperty::when($title = $request->get('title'), function ($query) use($title) {
            $query->whereTitle($title);
        })->pluck('value')->unique()->toArray();

        return Response::json([
            'data' => array_map(function ($value) {
                return [
                    'id' => $value,
                    'text' => $value
                ];
            }, $values)
        ]);
    }

    public function store(StorePromotionPropertyRequest $request, Promotion $promotion)
    {
        try {
            $promotion->properties()->create($request->validated());

            return Response::json([
                'message' => 'Характеристика добавлена'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }

    public function destroy(Promotion $promotion, PromotionProperty $property)
    {
        try {
            if ($property->delete())
                return Response::json([
                    'message' => 'Характеристика удалена'
                ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }
}
