<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\PropertyCategory;
use App\Models\Tag;
use App\Services\FileService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Nette\Utils\Image;

class CategoryController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Category::class);

        $categories = Category::query()->whereNull('category_id')->with('subcategories')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function search(Request $request) {
        $this->authorize('viewAny', Category::class);

        return response()->json(Category::query()
            ->select(['id', 'name'])
            ->where('name', 'like', '%'.$request->search.'%')->get());
    }

    public function show(Request $request, string $alias) {
        $query = Category::query();
        $query->where('alias', $alias);
        $category = $query->with('subcategories')->first();

        $this->authorize('view', $category);

        return response()->json($category);
    }

    public function create() {
        $this->authorize('create', Category::class);

        $categories = Category::query()->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request) {
        $this->authorize('create', Category::class);

        $data = $request->all();
        $image = FileService::saveFile('uploads', 'categories', $request->image);
        if ($image){
            $data['image'] = $image;
        }
        $data['add_to_top_menu'] = array_key_exists('add_to_top_menu', $data)?1:0;
        $curr_position = DB::table('categories')->max('position')??0;
        $data['position'] = $curr_position + 1;
        if (!array_key_exists('alias', $data) || $data['alias'] === null) {
            $data['alias'] = Str::slug($data['name'], '-');
        }
        $count = Category::query()->where('alias', 'like', $data['alias'].'%')->count();
        if ($count > 0) {
            $data['alias'] = $data['alias'].'_'.$count;
        }
        $category = new Category($data);
        if (!$category->save()) {
            redirect()->back()->with('error', 'Не удалось сохранить категорию');
        }
        if ($data['category_id'] !== null) {
            $data = PropertyCategory::query()
                ->select('category_id', 'property_id', 'position')
                ->where('category_id', $data['category_id'])->get();

            $data = $data->map(function ($item, int $key) use ($category) {
                $item['category_id'] = $category->id;
                return $item;
            });

            PropertyCategory::query()->insert($data->toArray());
        }
        else {
            redirect()->back()->with('error', 'Не удалось сохранить изображение');
        }
        return redirect()->route('admin.categories')->with('success', 'Категория создана');
    }

    public function delete($id) {
        $category = Category::query()->find($id);

        $this->authorize('delete', $category);

        if ($category->delete()) {
            FileService::removeFile('uploads', 'categories', $category->image);
            Category::query()->where('category_id', $category->id)->update([
                'category_id' => $category->category_id
            ]);
        }
        return redirect()->back()->with('succcess', 'Категория успешно удалена');
    }

    public function edit($id) {
        $categories = Category::query()->get();
        $category = $categories->find($id);

        $this->authorize('update', $category);

        $tags = $category->tags;
        $posts = CategoryPost::query()->where('category_id', $category->id)->orderBy('position')->get();
        $articles = Article::query()->where('record_id', $category->id)
            ->where('table_name', 'categories')
            ->orderBy('position')
            ->get();
        $last_position = $articles->max('position');
        $last_position = $last_position ? $last_position + 1: 1;
        $properties = PropertyCategory::query()->where('category_id', $category->id)->orderBy('position')->paginate();
        $seo = Category::query()->select('categories.*')->find($id);
        return view('admin.categories.edit', compact('category', 'categories', 'properties', 'tags', 'last_position', 'articles', 'seo', 'posts'));
    }

    public function update(Request $request){
        $data = $request->all();
        $category = Category::query()->find($data['id']);

        $this->authorize('update', $category);

        $data['add_to_top_menu'] = array_key_exists('add_to_top_menu', $data)? 1: 0;
        if (!array_key_exists('alias', $data) || $data['alias'] === null) {
            $data['alias'] = Str::slug($data['name'], '-');
        }
        $count = Category::query()
            ->where('alias', 'like', $data['alias'].'[0-9]*')
            ->whereNot('id', $request->id)->count();
        if ($count > 0) {
            $data['alias'] = $data['alias'].$count;
        }
        if(!$category) {
            return redirect()->back()->with('error', 'Категория не найдена');
        }
        if ($request->image_remove === '1') {
            FileService::removeFile('uploads', 'categories', $category->image);
        }
        else if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', 'categories', $request->image);
            if ($category->image !== null) {
                FileService::removeFile('uploads', 'categories', $category->image);
            }
            if ($image) {
                $data['image'] = $image;
            }
            else {
                return redirect()->back()->with('error', 'Не удалось сохранить изображение');
            }
        }
        $is_same_parent = false;
        if ($data['category_id'] !== null) {
            $is_same_parent = ((int)$data['category_id'] === (int)$category->category_id);
        }
        $category->update($data);
        if ($data['category_id'] !== null && !$is_same_parent) {
            $data = PropertyCategory::query()
                ->select('category_id', 'property_id', 'position')
                ->where('category_id', $data['category_id'])->get();

            PropertyCategory::query()->where('category_id', $category->id)->delete();

            $data = $data->map(function ($item, int $key) use ($category) {
                $item['category_id'] = $category->id;
                return $item;
            });

            PropertyCategory::query()->insert($data->toArray());
        }

        \Cache::forget('category_child_ids_' . $category->id);

        return redirect()->route('admin.categories')->with('success', 'Категория успешно отредактирована');
    }

    public function updateSeo(Request $request)
    {
        $productId = $request->input('id');

        $seo = Category::find($productId);

        $this->authorize('update', $seo);

        if ($seo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }
        $seo->title_meta = $request->title_meta;
        $seo->description_meta = $request->description_meta;
        $seo->keywords_meta = $request->keywords_meta;
        $seo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }

    public function updateMicroSeo(Request $request)
    {
        $productId = $request->input('id');

        $microSeo = Category::find($productId);

        $this->authorize('update', $microSeo);

        if ($microSeo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $microSeo->og_title_meta = $request->og_title_meta;
        $microSeo->og_description_meta = $request->og_description_meta;
        $microSeo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }

    public function deleteCategories(Request $request)
    {
        $categoriesId = $request->checkbox;
        if ($categoriesId) {
            $categories = Category::query()->whereIn('id', $categoriesId)->get();
            foreach ($categories as $category) {
                $this->authorize('delete', $category);

                if($category->image) {
                    FileService::removeFile('uploads', 'categories', $category->image);
                }
                Category::query()->where('category_id', $category->id)->whereNotIn('id', $categoriesId)->update([
                    'category_id' => $category->category_id
                ]);
            }
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

    public function updatePosition(Request $request) {
        foreach ($request->data as $pos => $new_position) {
            $parent_id = array_key_exists('parent_id', $new_position)?$new_position['parent_id']:null;
            $category = Category::query()->find($new_position['id']);

            $this->authorize('update', $category);

            $is_same_parent = false;
            if ($parent_id !== null) {
                $is_same_parent = ((int)$parent_id === (int)$category->category_id);
            }
            $category->update([
                'position' => $pos,
                'category_id' => $parent_id
            ]);
            if ($parent_id !== null && !$is_same_parent) {
                $data = PropertyCategory::query()
                    ->select('category_id', 'property_id', 'position')
                    ->where('category_id', $parent_id)->get();

                $data = $data->map(function ($item, int $key) use ($new_position) {
                    $item['category_id'] = $new_position['id'];
                    return $item;
                });

                PropertyCategory::query()->where('category_id', $new_position['id'])->delete();

                PropertyCategory::query()->insert($data->toArray());
            }
        }
        return response()->json(['status' => 'ok']);
    }

    public function updatePropertiesPosition(Request $request): \Illuminate\Http\JsonResponse
    {
        $positions = $request->post('positions');
        if ($positions) {
            foreach ($positions as $position) {
                $property_category = PropertyCategory::findOrFail($position['id']);
                $property_category->position = $position['position'];
                $property_category->save();
            }
        }

        $property_category = PropertyCategory::pluck('position', 'id');
        return response()->json($property_category);
    }
}
