<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftProduct;
use App\Services\Admin\GiftService;
use App\Services\FileService;
use Illuminate\Http\Request;

class GiftProductController extends Controller
{

    public function __construct(private GiftService $giftService)
    {
        $this->authorizeResource(GiftProduct::class, 'gift_product');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->post();
            $data['is_available'] = $request->boolean('is_available');

            if (!$request->hasFile('img'))
                throw new \Exception('Изображение обязательно!');

            $img = FileService::saveFile('uploads', GiftProduct::IMAGES_PATH, $request->file('img'));
            if (!$img)
                throw new \Exception('Не удалось сохранить изображение!');

            $data['img'] = $img;

            GiftProduct::create($data);

            return back()->with('success', 'Подарочный товар успешно добавлен');
        } catch (\Exception $exception) {
            return back()->withErrors(["ОШИБКА: {$exception->getMessage()}"]);
        }
    }

    public function show(Request $request, GiftProduct $giftProduct)
    {
        if ($request->wantsJson()) {
            $giftProduct->update_url = route('admin.gift_products.update', $giftProduct);
            $giftProduct->img_src = $giftProduct->getImgSrc();
            return $giftProduct;
        }

        return to_route('admin.gifts.index');
    }

    public function update(Request $request, GiftProduct $giftProduct)
    {
        $data = $request->post();
        $data['is_available'] = $request->boolean('is_available');

        if ($request->hasFile('img')) {
            $img = FileService::saveFile('uploads', GiftProduct::IMAGES_PATH, $request->file('img'));
            FileService::removeFile('uploads', GiftProduct::IMAGES_PATH, $giftProduct->img);
            $data['img'] = $img;
        }

        if ($giftProduct->update($data)) {
            if ($request->wantsJson())
                return ['result' => true];

            return back()->with('success', 'Подарочный товар обновлён');
        }

        if ($request->wantsJson())
            return ['result' => false];

        return back()->withErrors(['Не удалось обновить подарочный товар']);
    }

    public function destroy(Request $request, GiftProduct $giftProduct)
    {
        if ($giftProduct->delete())
            return back()->with('success', 'Подарочный товар удалён');

        return back()->withErrors(['Не удалось удалить подарочный товар']);
    }

}
