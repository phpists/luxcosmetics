<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        $query->select('articles.*');

        $article = $query->paginate(15);

        return view('admin.article.index', compact('article'));
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $link = $request->link ?? Str::slug($request->title);

        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'text' => $validatedData['text'],
            'link' => $link,
            'status' => $request->status,
            'image' => ImageService::saveImage('uploads', "article", $request->image),
            'published_at' => $request->published_at
        ]);


        return redirect()->route('admin.article')->with('success', 'Данные успешно сохранены');
    }

    public function edit($id)
    {

        $data['item'] = Article::select('articles.*')
            ->where('articles.id', $id)
            ->first();

        return view('admin.article.edit', $data);
    }

    public function update(Request $request)
    {
        $item = Article::find($request->id);

        if ($request->hasFile('image')) {
            $image = ImageService::saveImage('uploads', "article", $request->image);
            $item->image = $image;
            $item->update(['image' => $image]);
        }else{
            $item->update($request->all());
        }

        return redirect()->route('admin.article')->with('success', 'Данные успешно отредактированы');
    }

    public function delete($id)
    {
        $item = Article::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.article')->with('success', 'Данные успешно удалены');
    }
}
