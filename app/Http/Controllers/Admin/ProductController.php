<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Services\CatalogService;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::query()->select('products.*')->get();
        $query = Product::query();
        $query->select('products.*');

        if ($request->name) {
            $query->where('products.title', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->alias) {
            $query->where('products.alias', 'LIKE', '%' . $request->alias . '%');
        }

        if ($request->code) {
            $query->where('products.code', 'LIKE', '%' . $request->code . '%');
        }

        if (isset($request->status)) {
            $query->where('products.status', $request->status);
        }

        $productAjax = $query->paginate($request->paginate ?? 100);

        if ($request->ajax()) {
            $categoriesAjaxHtml = view('admin.products.parts.table', ['productAjax' => $productAjax])->render();
            $paginateHtml = view('admin.products.parts.paginate', ['productAjax' => $productAjax, 'params' => $request->all()])->render();

            return response()->json([
                'categoriesAjaxHtml' => $categoriesAjaxHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }

        return response()->view('admin.products.index', compact('products','productAjax'));
    }

    public function create() {
        $categories = Category::query()
            ->select('id', 'name')
            ->get();
        $brands = Brand::query()
            ->select('id', 'name')
            ->get();
        return response()->view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request) {
        $request->validate([
           'alias' => 'unique:products'
        ]);
        $data = $request->all();
        $data['show_in_discount'] = array_key_exists('show_in_discount', $data)? 1: 0;
        $data['show_in_popular'] = array_key_exists('show_in_popular', $data)? 1: 0;
        $data['show_in_new'] = array_key_exists('show_in_new', $data)? 1: 0;
        $data['show_in_sales_page'] = array_key_exists('show_in_sales_page', $data)? 1: 0;
        $data['show_in_percent_discount_page'] = array_key_exists('show_in_percent_discount_page', $data)? 1: 0;
        $data['show_in_new_page'] = array_key_exists('show_in_new_page', $data)? 1: 0;
        if (!array_key_exists('alias', $data) || $data['alias'] === null) {
            $data['alias'] = Str::slug($data['title'], '-');
        }
        $count = Product::query()->where('alias', 'like', $data['alias'].'%')->count();
        if ($count > 0) {
            $data['alias'] = $data['alias'].'_'.$count;
        }
        $product = new Product($data);
        if ($product->save()) {
            $image_path = FileService::saveFile('uploads', "products", $request->image);
            if ($image_path !== false) {
                $image_id = DB::table('product_images')->insertGetId([
                    'path' => $image_path,
                    'record_id' => $product->id
                ]);
                $product->update([
                    'image_print_id' => $image_id
                ]);
            }
            $variations_id = $request->variations_id??[];
            $product_variations = [];
            foreach ($variations_id as $variation_id) {
                $product_variations[] = [
                    'variation_id' => $variation_id,
                    'product_id' => $product->id
                ];
            }
            ProductVariation::query()->insert($product_variations);
        }
        return redirect()->route('admin.products')->with('success', 'Товар успешно добавлен');
    }

    public function edit(Request $request, string $id) {
        $product = Product::query()
            ->select('products.*', 'product_images.path as image')
            ->leftJoin('product_images', 'products.image_print_id', 'product_images.id')
            ->find($id);

        $categories = Category::query()
            ->select('id', 'name')
            ->get();
        $brands = Brand::query()
            ->select('id', 'name')
            ->get();
        $product_images = DB::table('product_images')
            ->where('record_id', $product->id)
            ->get();

        $product_variations = CatalogService::getProductVariations($product->id, $product->base_property_id);

        $articles = Article::query()
            ->where('record_id', $product->id)
            ->where('table_name', 'products')
            ->orderBy('position')
            ->get();
        $last_position = $articles->max('position');
        $last_position = $last_position ? $last_position + 1: 1;

        $seo = Product::query()->select('products.*')->find($id);

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'product_images', 'product_variations', 'last_position', 'articles', 'seo'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::query()->findOrFail($id);
        $data = $request->all();
        $data['show_in_discount'] = array_key_exists('show_in_discount', $data)? 1: 0;
        $data['show_in_popular'] = array_key_exists('show_in_popular', $data)? 1: 0;
        $data['show_in_new'] = array_key_exists('show_in_new', $data)? 1: 0;
        $data['show_in_sales_page'] = array_key_exists('show_in_sales_page', $data)? 1: 0;
        $data['show_in_percent_discount_page'] = array_key_exists('show_in_percent_discount_page', $data)? 1: 0;
        $data['show_in_new_page'] = array_key_exists('show_in_new_page', $data)? 1: 0;
        $product->length_product = $data['length_product'];
        $product->width_product = $data['width_product'];
        $product->height_product = $data['height_product'];
        $product->weight_product = $data['weight_product'];

        if (!array_key_exists('alias', $data) || $data['alias'] === null) {
            $data['alias'] = Str::slug($data['title'], '-');
        }

        $count = Product::query()
            ->where('alias', 'like', $data['alias'].'%')
            ->whereNot('id', $product->id)
            ->count();
        if ($count > 0) {
            $data['alias'] = $data['alias'].'_'.$count;
        }
        $product->update($data);

        $variations_id = $request->variations_id ?? false;
        if ($variations_id) {
            $variations_id[] = $product->id;
        }

        ProductVariation::query()
            ->where('product_id', $product->id)
            ->orWhere('variation_id', $product->id)
            ->delete();

        if (is_array($variations_id)) {
            $product_variations = [];
            foreach ($variations_id as $variation_id) {
                ProductVariation::query()
                    ->where('product_id', $variation_id)
                    ->orWhere('variation_id', $variation_id)
                    ->delete();

                foreach ($variations_id as $second_variation_id) {
                    if ($variation_id === $second_variation_id)
                        continue;

                    $product_variations[] = [
                        'variation_id' => $variation_id,
                        'product_id' => $second_variation_id
                    ];
                }
            }

            ProductVariation::query()->insert($product_variations);
        }

        return back();
//        return redirect()->route('admin.products')->with('success', 'Товар успешно обновлен');
    }

    public function updateSeo(Request $request)
    {
        $seo = Product::query()->select('products.*')->first();

        if ($seo === null) {
            $seo = new Product([
                'title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
            ]);
            $seo->save();
        } else {
            $seo->title = $request->meta_title;
            $seo->description_meta = $request->meta_description;
            $seo->keywords_meta = $request->meta_keywords;
            $seo->save();
        }

        return redirect()->back()->with('success', 'Seo обновлено');
    }


    public function storeImage(Request $request) {
        $image_path = FileService::saveFile('uploads', "products", $request->image);
        if($image_path) {
            $imageId = DB::table('product_images')->insertGetId([
                'path' => $image_path,
                'record_id' => $request->product_id,
                'is_active' => $request->is_active
            ]);
            if ($request->is_main == 1) {
                DB::table('products')->where('id', $request->product_id)->update([
                    'image_print_id' => $imageId
                ]);
            }
        }
        return redirect()->route('admin.products')->with('success', 'Изображение создано');
    }

    public function deleteImage($id) {
        DB::table('product_images')->where('id', $id)->delete();
        return redirect()->route('admin.products')->with('success', 'Изображение удалено');
    }

    public function updateImage(Request $request) {
        DB::table('product_images')->where('id', $request->image_id)->update([
            'is_active' => $request->is_active
        ]);

        if ($request->is_main == 1) {
            DB::table('products')->where('id', $request->product_id)->update([
                'image_print_id' => $request->image_id
            ]);
        }
        return redirect()->back()->with('success', 'Изображение успешно обновлено');
    }

    public function storeVariation(Request $request) {
        $product_variation = new ProductVariation($request->all());
        $product_variation->save();
        return redirect()->back()->with('success', 'Модификация создано');
    }

    public function deleteVariation($id) {
        DB::table('product_variations')->where('id', $id)->delete();
        return redirect()->route('admin.products')->with('success', 'Модификация удалена');
    }

    public function updateVariation(Request $request){
        $product_variation = ProductVariation::query()->find($request->variation_id);
        $product_variation->update($request->all());
        redirect()->back()->with('success', 'Модификация успешно отредактировано');
    }

    public function showVariation(Request $request) {
        $product_variation = ProductVariation::query()->find($request->id);
        return response()->json($product_variation);
    }


    public function delete(Request $request, $id) {
        Product::query()->find($id)->delete();
        $images = DB::table('product_images')->where('id', $id)->get();
        foreach ($images as $image) {
            FileService::removeFile('uploads', 'products', $image);
        }
        DB::table('product_images')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Товар удален успешно');
    }

    public function deleteProducts(Request $request) {
        $product_ids = $request->checkbox;
        Product::query()->whereIn('id', $product_ids)->delete();
        return response()->json([
            'status' => true,
            'products' => $product_ids,
            'message' => 'Товары успешно удалены!'
        ]);
    }


    public function getProperties(Request $request)
    {
        $category = Category::find($request->get('category_id'));

        return new JsonResponse($category->properties);
    }

}
