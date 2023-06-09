<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use App\Services\ImageService;
use Illuminate\Http\Request;

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
        NewsItem::create([
            'title' => $request->title,
            'text' => $request->text,
            'link' => $request->link,
            'status' => $request->status,
            'image' => ImageService::saveImage('uploads', "news", $request->image),
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.news')->with('success', 'Дані успішно збережені');
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

        $item = NewsItem::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $image = ImageService::saveImage('uploads', "news", $request->image);
            $item->image = $image;
        }
        
        $item->update($request->all());

        return redirect()->route('admin.news')->with('success', 'Дані успішно відредаговані');
    }

    public function delete($id)
    {
        $item = NewsItem::find($id);
        $item->delete();

        return redirect()->route('admin.news')->with('success', 'Дані успішно видалені');
    }
}
