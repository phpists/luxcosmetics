<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ProductPrice::class);
    }

    public function index()
    {
        $productPrices = ProductPrice::paginate();

        return view('admin.product-prices.index', [
            'productPrices' => $productPrices,
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');

            $productPrice = new ProductPrice([
                ...$request->only('title', 'type', 'amount', 'rounding'),
                'is_active' => $request->boolean('is_active'),
                'start_date' => $start_date ? Carbon::parse($start_date)->format('Y-m-d') : null,
                'end_date' => $end_date ? Carbon::parse($end_date)->format('Y-m-d') : null,
            ]);

            if (!$productPrice->save())
                throw new \Exception('Could not create product price');

            foreach ($request->get('cases', []) as $modelType => $modelIds) {
                foreach ($modelIds as $modelId) {
                    $productPrice->cases()->create([
                        'model_type' => $modelType,
                        'model_id' => $modelId,
                    ]);
                }
            }
            foreach ($request->get('excepts', []) as $modelType => $modelIds) {
                foreach ($modelIds as $modelId) {
                    $productPrice->excepts()->create([
                        'model_type' => $modelType,
                        'model_id' => $modelId,
                    ]);
                }
            }

            $productPrice->save();

            return to_route('admin.product-prices.index')->with('success', 'Условие успешно создано');
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
            return to_route('admin.product-prices.index')->with('error', 'Ошибка!');
        }
    }

    public function show(Request $request, ProductPrice $productPrice)
    {
        $productPriceArr = $productPrice->toArray();
        return [
            ...$productPriceArr,
            'case_brands' => $productPrice->caseBrands()->select('model_id')->pluck('model_id')->values(),
            'case_categories' => $productPrice->caseCategories()->select('model_id')->pluck('model_id')->values(),
            'case_products' => $productPrice->caseProducts()->select('model_id')->pluck('model_id')->values(),
            'except_brands' => $productPrice->exceptBrands()->select('model_id')->pluck('model_id')->values(),
            'except_categories' => $productPrice->exceptCategories()->select('model_id')->pluck('model_id')->values(),
            'except_products' => $productPrice->exceptProducts()->select('model_id')->pluck('model_id')->values(),
        ];
    }

    public function update(Request $request, ProductPrice $productPrice)
    {
        try {
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');

            $productPrice->fill([
                ...$request->only('title', 'type', 'amount', 'rounding'),
                'is_active' => $request->boolean('is_active'),
                'start_date' => $start_date ? Carbon::parse($start_date)->format('Y-m-d') : null,
                'end_date' => $end_date ? Carbon::parse($end_date)->format('Y-m-d') : null,
            ]);

            if (!$productPrice->update())
                throw new \Exception('Could not update product price');

            $productPrice->cases()->delete();
            foreach ($request->get('cases', []) as $modelType => $modelIds) {
                foreach ($modelIds as $modelId) {
                    $productPrice->cases()->create([
                        'model_type' => $modelType,
                        'model_id' => $modelId,
                    ]);
                }
            }

            $productPrice->excepts()->delete();
            foreach ($request->get('excepts', []) as $modelType => $modelIds) {
                foreach ($modelIds as $modelId) {
                    $productPrice->excepts()->create([
                        'model_type' => $modelType,
                        'model_id' => $modelId,
                    ]);
                }
            }

            return to_route('admin.product-prices.index')->with('success', 'Условие успешно обновлено');
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
            return to_route('admin.product-prices.index')->with('error', 'Ошибка!');
        }
    }

    public function updateStatus(Request $request)
    {
        $this->authorize('update', new ProductPrice);

        $productPrice = ProductPrice::find($request->get('id'));
        $productPrice->is_active = $request->boolean('is_active');
        $productPrice->update();
    }

    public function updatePositions(Request $request)
    {
        $this->authorize('update', new ProductPrice);

        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {

                $faq = ProductPrice::findOrFail($position['id']);
                $faq->pos = $position['position'];
                $faq->save();
            }
        }
    }

    public function destroy(Request $request, ProductPrice $productPrice)
    {
        if ($productPrice->delete()) {
            return to_route('admin.product-prices.index')->with('success', 'Условние удалено');
        } else {
            return to_route('admin.product-prices.index')->with('error', 'Ошибка!');
        }
    }

}
