<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\NewsImage;
use App\Models\NewsItem;
use App\Services\FileService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsImageController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', NewsItem::class);

        $data = $request->all();

        $position = NewsImage::query()->where('news_item_id', $data['news_item_id'])->max('position');

        $position = $position? $position + 1: 1;

        $data['position'] = $position;

        $image_path = FileService::saveFile('uploads', NewsImage::IMAGE_PATH, $data['image_path']);

        $data['image_path'] = $image_path;
        $image = new NewsImage($data);

        if (!$image->save()) {
            return redirect()->back()
                ->with('error', 'Не удалось сохранить изображение')
                ->with('active_tab_id', 'images_tab');
        }

        return redirect()->back()
            ->with('success', 'Данные успешно сохранены')
            ->with('active_tab_id', 'images_tab');
    }

    public function updateImagesPosition(Request $request) {
        $this->authorize('update', NewsItem::class);

        $images_positions = $request->images_positions;

        foreach ($images_positions as $position => $image_id) {
            NewsImage::query()->where('id', $image_id)->update([
                'position' => $position + 1
            ]);
        }

        return response()->json($images_positions);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $this->authorize('delete', NewsItem::class);

        $item = NewsImage::findOrFail($id);
        $item->delete();

        return redirect()->back()
            ->with('success', 'Данные успешно удалены')
            ->with('active_tab_id', 'images_tab');
    }

}
