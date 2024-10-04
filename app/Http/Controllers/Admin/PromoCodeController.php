<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\PromoCodeCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PromoCodeController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(PromoCode::class, 'promo_code');
    }

    public function index()
    {
        return view('admin.promo-codes.index', [
            'promo_codes' => PromoCode::latest()->paginate(),
            'categories' => Category::all(),
            'products' => Product::all(),
            'brands' => Brand::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->post();
            $model_ids = $data['product_ids'] ?? $data['category_ids'] ?? $data['brand_ids'] ?? [];
            unset($data['product_ids']);
            unset($data['category_ids']);
            unset($data['brand_ids']);

            if (isset($data['code']) && !empty($data['code'])) {
                if ($this->isCodeExists($data['code']))
                    throw new \Exception('Промокод з таким кодо уже существует!');
            } else {
                $data['code'] = $this->getUniqueCode();
            }

            $promoCode = PromoCode::create($data);

            $promoCode->cases()->createMany(array_map(function($item) use($promoCode) {
                return [
                    'model_id' => $item,
                    'model_type' => match ($promoCode->type) {
                        PromoCode::TYPE_BRAND => Brand::class,
                        PromoCode::TYPE_CATEGORY => Category::class,
                        PromoCode::TYPE_PRODUCT => Product::class,
                    }
                ];
            }, $model_ids));

            Session::flash('success', 'Промокод успешно создан');

            if ($request->wantsJson())
                return new JsonResponse(['result' => true]);

            return back()->with('success');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', "ОШИБКА: {$exception->getMessage()}");
        }
    }

    public function show(Request $request, PromoCode $promoCode) {
        $promoCodeArr = $promoCode->toArray();

        $orders = [];
        foreach ($promoCode->orders as $order)
            $orders["Заказ №{$order->num}"] = route('admin.orders.show', $order);
        $promoCodeArr['orders'] = $orders;

        if ($request->wantsJson())
            return $promoCodeArr;

        return back();
    }

    public function destroy(Request $request, PromoCode $promoCode)
    {
        $promoCode->delete();

        return back()->with('success', 'Промо код удалён');
    }



    private function getUniqueCode()
    {
        $code = Str::random(8);

        if ($this->isCodeExists($code))
            return $this->getUniqueCode();

        return $code;
    }

    private function isCodeExists($code): bool
    {
        return PromoCode::where('code', $code)->exists();
    }

}
