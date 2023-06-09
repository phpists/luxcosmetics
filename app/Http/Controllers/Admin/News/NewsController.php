<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsItem::query();

        $query->select('news_item.*');

        $news = $query->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $link = $request->link ?? Str::slug($request->title);

        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        NewsItem::create([
            'title' => $request->title,
            'text' => $validatedData['text'],
            'link' => $link,
            'status' => $request->status,
            'image' => ImageService::saveImage('uploads', "news", $request->image),
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.news')->with('success', 'Данные успешно сохранены');
    }

    public function edit($id)
    {

        $data['item'] = NewsItem::select('news_item.*')
            ->where('news_item.id', $id)
            ->first();

        return view('admin.news.edit', $data);
    }

    public function update(Request $request)
    {
        $item = NewsItem::find($request->id);

        if ($request->hasFile('image')) {
            $image = ImageService::saveImage('uploads', "news", $request->image);
            $item->image = $image;
            $item->update(['image' => $image]);
        }else{
            $item->update($request->all());
        }

        return redirect()->route('admin.news')->with('success', 'Данные успешно отредактированы');
    }

    public function delete($id)
    {
        $item = NewsItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.news')->with('success', 'Данные успешно удалены');
    }
}
