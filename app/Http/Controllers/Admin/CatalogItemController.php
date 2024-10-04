<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogItemResource;
use App\Models\CatalogItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogItemController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(CatalogItem::class);
    }

    public function index()
    {
        return view('admin.catalog-items.index', [
            'catalogItems' => CatalogItem::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        $catalogItem = new CatalogItem($data);
        $img = $request->file('img');
        if ($img && Storage::disk('uploads')->put(CatalogItem::IMAGES_PATH, $img))
            $catalogItem->img = $img->hashName();

        if ($catalogItem->save()) {
            return back()->with('success', 'Элемент добавлен');
        }

        return back()->with('error', 'ОШИБКА');
    }

    public function show(CatalogItem $catalogItem)
    {
        return new CatalogItemResource($catalogItem);
    }

    public function update(Request $request, CatalogItem $catalogItem)
    {
        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('img')) {
            if ($catalogItem->img)
                Storage::disk('uploads')->delete(CatalogItem::IMAGES_PATH . '/' . $catalogItem->img);

            $img = $request->file('img');
            if (Storage::disk('uploads')->put(CatalogItem::IMAGES_PATH, $img))
                $data['img'] = $img->hashName();
        }

        if ($catalogItem->update($data))
            return back()->with('success', 'Элемент обновлен');

        return back()->with('error', 'ОШИБКА');
    }

    public function updateStatus(Request $request)
    {
        $this->authorize('update', new CatalogItem);

        $catalogItem = CatalogItem::find($request->get('id'));
        $catalogItem->update([
            'is_active' => $request->boolean('is_active'),
        ]);
    }

    public function updatePositions(Request $request)
    {
        $this->authorize('update', new CatalogItem);

        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $catalogItems = CatalogItem::findOrFail($position['id']);
                $catalogItems->pos = $position['position'];
                $catalogItems->save();
            }
        }
    }

    public function destroy(CatalogItem $catalogItem)
    {
        if ($catalogItem->delete())
            return back()->with('success', 'Элемент удален');

        return back()->with('error', 'ОШИБКА');
    }

}
