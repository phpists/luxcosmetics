<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ImageService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nette\Utils\Image;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
    public function show(Request $request, string $alias) {
        $query = Category::query();
        $query->where('alias', $alias);
        $category = $query->with('subcategories')->first();
        return response()->json($category);
    }

    public function create() {
        $categories = Category::query()->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $image = ImageService::saveImage('uploads', 'categories', $request->image);
        if ($image){
            $data['image'] = $image;
            $data['add_to_top_menu'] = array_key_exists('add_to_top_menu', $data)?1:0;
            $curr_position = DB::table('categories')->max('position')??0;
            $data['position'] = $curr_position + 1;
            $category = new Category($data);
            if (!$category->save()) {
                redirect()->back()->with('error', 'Не удалось сохранить категорию');
            }
        }
        else {
            redirect()->back()->with('error', 'Не удалось сохранить изображение');
        }
        return redirect()->route('admin.categories')->with('success', 'Категория создана');
    }

    public function delete($id) {
        $category = Category::query()->find($id);
        if ($category->delete()) {
            ImageService::removeImage('uploads', 'categories', $category->image);
        }
        return redirect()->back()->with('succcess', 'Категория успешно удалена');
    }

    public function edit($id) {
        $categories = Category::query()->get();
        $category = $categories->find($id);
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request){
        $data = $request->all();
        $category = Category::query()->find($data['id']);
        $data['add_to_top_menu'] = array_key_exists('add_to_top_menu', $data)? 1: 0;
        if(!$category) {
            return redirect()->back()->with('error', 'Категория не найдена');
        }
        if ($request->hasFile('image')) {
            $image = ImageService::saveImage('uploads', 'categories', $request->image);
            if ($image) {
                $data['image'] = $image;
            }
            else {
                return redirect()->back()->with('error', 'Не удалось сохранить изображение');
            }
        }
        $category->update($data);
        return redirect()->route('admin.categories')->with('success', 'Категория успешно отредактирована');
    }

    public function deleteCategories(Request $request)
    {
        $categoriesId = $request->checkbox;
        if ($categoriesId) {
            Category::whereIn('id', $categoriesId)->delete();
        }

        return response()->json([
            'status' => true,
            'categories' => $categoriesId,
            'message' => 'Категории успешно удалены!'
        ]);
    }

    public function activeCategories(Request $request)
    {
        $categoriesId = $request->checkbox;
        $status = $request->status;
        if ($categoriesId) {
            Category::whereIn('id', $categoriesId)->update([
                'status' => $status
            ]);
        }

        $title = SiteService::getStatus($status);
        $message = $status ? 'Категории активированы!' : 'Категории деактивированы!';

        return response()->json([
            'categories' => $categoriesId,
            'title' => $title,
            'message' => $message
        ]);
    }
}
