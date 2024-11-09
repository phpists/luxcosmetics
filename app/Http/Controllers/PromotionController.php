<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\PromotionProperty;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $promotions = Promotion::active()
            ->when($filters = $request->input('filters'), function ($query) use ($filters) {
                foreach ($filters as $title => $values) {
                    $query->whereHas('properties', function ($query) use ($title, $values) {
                        $query->where(function ($query) use ($title, $values) {
                            foreach ($values as $value) {
                                $query->orWhere(function ($query) use ($title, $value) {
                                    $query->where('title', $title)
                                        ->where('value', $value);
                                });
                            }
                        });
                    });
                }
            })
            ->orderBy('starts_at', 'desc')
            ->paginate(6);

        if ($request->ajax()) {
            if ($request->input('load_more')) {
                return response()->json([
                    'promotions' => view('promotion.__items', [
                        'promotions' => $promotions
                    ])->render(),
                    'pagination' => $promotions->links('vendor.pagination.products_pagination', ['moreItemName' => ''])->toHtml()
                ]);
            }

            return view('promotion._list', [
                'promotions' => $promotions
            ]);
        }

        $properties = PromotionProperty::whereHas('promotion', function ($query) {
            $query->active();
        })
            ->select('title', 'value')
            ->groupBy('title', 'value')
            ->get()
            ->groupBy('title')
            ->map(function ($group) {
                return $group->pluck('value')->unique();
            });

        return view('promotion.index', [
            'promotions' => $promotions,
            'properties' => $properties,
        ]);
    }

    public function show(Promotion $promotion)
    {
        return view('promotion.show', [
            'promotion' => $promotion,
        ]);
    }
}
