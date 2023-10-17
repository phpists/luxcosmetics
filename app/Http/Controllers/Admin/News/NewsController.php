<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\NewsImage;
use App\Models\NewsItem;
use App\Services\FileService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', NewsItem::class);

        $query = NewsItem::query();

        $query->select('news_item.*');

        $news = $query->orderBy('id', 'desc')->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $this->authorize('create', NewsItem::class);

        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', NewsItem::class);

        $link = $request->link ?? Str::slug($request->title);

        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        $image = FileService::saveFile('uploads', "news", $request->image);
        $thumbnail_filename = null;
        if ($image) {
            $thumbnail_filename = 'tmb_' . $image;
            $thumbnail = Image::make($request->file('image')->getRealPath());
            $thumbnail->fit(411, 267, function ($constraint) {
                $constraint->upsize();
            });
            $thumbnail->save('images/uploads/news/' . $thumbnail_filename);
        }

        NewsItem::create([
            'title' => $request->title,
            'text' => $validatedData['text'],
            'link' => $link,
            'status' => $request->status,
            'image' => $image,
            'thumbnail' => $thumbnail_filename,
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.news')->with('success', 'Данные успешно сохранены');
    }

    public function edit($id)
    {
        $this->authorize('update', NewsItem::class);

        $data['item'] = NewsItem::select('news_item.*')->where('news_item.id', $id)->first();
        $seo = NewsItem::query()->select('news_item.*')->find($id);
        return view('admin.news.edit', $data, compact('seo'));
    }

    public function update(Request $request)
    {
        $this->authorize('update', NewsItem::class);

        $item = NewsItem::find($request->id);

        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', "news", $request->image);
            $thumbnail_filename = null;
            if ($image) {
                $thumbnail_filename = 'tmb_' . $image;
                $thumbnail = Image::make($request->file('image')->getRealPath());
                $thumbnail->fit(411, 267, function ($constraint) {
                    $constraint->upsize();
                });
                $thumbnail->save('images/uploads/news/' . $thumbnail_filename);
            }
            $item->image = $image;
            $item->update([
                'image' => $image,
                'thumbnail' => $thumbnail_filename
            ]);
        }else{
            $data = $request->all();
            $data['link'] = $request->link ?? Str::slug($request->title);

            $item->update($data);
        }
        return redirect()->route('admin.news')->with('success', 'Данные успешно отредактированы');
    }

    public function updateSeo(Request $request)
    {
        $this->authorize('update', NewsItem::class);

        $productId = $request->input('id');

        $seo = NewsItem::find($productId);

        if ($seo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $seo->description_meta = $request->description_meta;
        $seo->keywords_meta = $request->keywords_meta;
        $seo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }

    public function updateMicroSeo(Request $request)
    {
        $this->authorize('update', NewsItem::class);

        $productId = $request->input('id');

        $microSeo = NewsItem::find($productId);

        if ($microSeo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $microSeo->og_title_meta = $request->og_title_meta;
        $microSeo->og_description_meta = $request->og_description_meta;
        $microSeo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }

    public function delete($id)
    {
        $this->authorize('delete', NewsItem::class);

        $item = NewsItem::findOrFail($id);
        NewsImage::query()->where('news_item_id', $item->id)->delete();
        $item->delete();

        return redirect()->route('admin.news')->with('success', 'Данные успешно удалены');
    }

    public function activePosts(Request $request)
    {
        $this->authorize('update', NewsItem::class);

        $id = $request->id;
        $newsId = $request->checkbox;
        $status = $request->status;

        if ($id) {
            NewsItem::where('id', $id)->update([
                'status' => $status
            ]);
        } elseif ($newsId) {
            NewsItem::whereIn('id', $newsId)->update([
                'status' => $status
            ]);
        }

        $title = SiteService::statusNews($status);
        $message = $status ? 'Новость активирована!' : 'Новость деактивирована!';

        $data = [
            'posts' => $id ?? $newsId,
            'title' => $title,
            'message' => $message
        ];

        return json_encode($data);
    }
}
