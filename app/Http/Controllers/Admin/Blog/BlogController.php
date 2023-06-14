<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogItem;
use App\Services\ImageService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogItem::query();

        $query->select('blog_items.*');

        $blog = $query->paginate(15);

        return view('admin.blog.index', compact('blog'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        BlogItem::create([
            'title' => $request->title,
            'text' => $request->text,
            'link' => $request->link,
            'status' => $request->status,
            'image' => ImageService::saveImage('uploads', "blog", $request->image),
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.blog')->with('success', 'Данные успешно сохранены');
    }

    public function edit($id)
    {

        $data['item'] = BlogItem::select('blog_items.*')
            ->where('blog_items.id', $id)
            ->first();

        return view('admin.blog.edit', $data);
    }

    public function update(Request $request)
    {
        $item = BlogItem::find($request->id);

        if ($request->hasFile('image')) {
            $image = ImageService::saveImage('uploads', "blog", $request->image);
            $item->image = $image;
            $item->update(['image' => $image]);
        }else{
            $item->update($request->all());
        }

        return redirect()->route('admin.blog')->with('success', 'Данные успешно отредактированы');
    }

    public function delete($id)
    {
        $item = BlogItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.blog')->with('success', 'Данные успешно удалены');
    }
}
