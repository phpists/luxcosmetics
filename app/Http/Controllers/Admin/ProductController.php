<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AvailableOptions;
use App\Http\Controllers\Controller;
use App\Imports\ProductPricesImport;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\RelatedProduct;
use App\Services\CatalogService;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();
        $this->authorize('viewAny', Product::class);
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

        if ($request->code_1c) {
            $query->where('products.code_1c', 'LIKE', '%' . $request->code_1c . '%');
        }

        if ($request->category_id) {
            $query->where('products.category_id', '=', $request->category_id);
        }

        if ($request->brand_id) {
            $query->where('products.brand_id', '=', $request->brand_id);
        }

        if (isset($request->availability)) {
            $query->where('products.availability', $request->availability);
        }

        $products = $query->paginate($request->paginate ?? 24);

        if ($request->ajax()) {
            $categoriesAjaxHtml = view('admin.products.parts.table', ['products' => $products])->render();
            $paginateHtml = view('admin.products.parts.paginate', ['products' => $products, 'params' => $request->all()])->render();

            return response()->json([
                'categoriesAjaxHtml' => $categoriesAjaxHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }

        return response()->view('admin.products.index', compact('products'));
    }

    public function create() {
        $this->authorize('create', Product::class);

        $categories = Category::query()
            ->select('id', 'name')
            ->get();
        $brands = Brand::query()
            ->select('id', 'name')
            ->get();
        return response()->view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request) {
        $this->authorize('create', Product::class);

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
        $data['items_left'] = $data['items_left'] ?? 0;
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

            $product_categories = $request->post('product_categories');
            if (is_array($product_categories)) {
                foreach ($product_categories as $i => $category_id) {
                    ProductCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $category_id
                    ]);
                }
            }
        }
        return redirect()->route('admin.products')->with('success', 'Товар успешно добавлен');
    }

    public function edit(Request $request, string $id) {
        $product = Product::query()
            ->select('products.*', 'product_images.path as image')
            ->leftJoin('product_images', 'products.image_print_id', 'product_images.id')
            ->find($id);

        $this->authorize('update', $product);

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

        $related_products = RelatedProduct::query()->where('product_id', $product->id)->get();

        $articles = Article::query()
            ->where('record_id', $product->id)
            ->where('table_name', 'products')
            ->orderBy('position')
            ->get();
        $last_position = $articles->max('position');
        $last_position = $last_position ? $last_position + 1: 1;

        $seo = Product::query()->select('products.*')->find($id);

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'product_images', 'product_variations', 'last_position', 'articles', 'seo', 'related_products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::query()->findOrFail($id);

        $this->authorize('update', $product);

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

        $product->country_products = $data['country_products'];
        $product->storage_conditions = $data['storage_conditions'];
        $product->allergy = $data['allergy'];
        $product->expiry_date = $data['expiry_date'];
        $product->spyrt = $data['spyrt'];
        $data['items_left'] = $data['items_left'] ?? 0;
        if ($data['items_left'] > 0) {
            $data['availability'] = AvailableOptions::AVAILABLE->value;
        } else {
            if ($product->availability == AvailableOptions::AVAILABLE->value)
                $data['availability'] = AvailableOptions::NOT_AVAILABLE->value;
        }

        if (!array_key_exists('alias', $data) || $data['alias'] === null) {
            $data['alias'] = Str::slug($data['title'], '-');
        }

        $related_products = [];

        RelatedProduct::query()->where('product_id', $product->id)->delete();

        if (array_key_exists('support_item_id', $data)) {
            foreach ($data['support_item_id'] as $item_id) {
                $related_products[] = [
                    'product_id' => $product->id,
                    'relative_product_id' => $item_id,
                    'relation_type' => RelatedProduct::SUPPORT_ITEMS
                ];
            }
        }

        if (array_key_exists('similar_item_id', $data)) {
            foreach ($data['similar_item_id'] as $item_id) {
                $related_products[] = [
                    'product_id' => $product->id,
                    'relative_product_id' => $item_id,
                    'relation_type' => RelatedProduct::SIMILAR_ITEMS
                ];
            }
        }

        if (sizeof($related_products) > 0) {
            RelatedProduct::query()->insert($related_products);
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

        $product_categories = $request->post('product_categories');
        if ($product->productCategories->isNotEmpty()) {
            foreach ($product->productCategories as $productCategory)
                $productCategory->delete();
        }
        if (is_array($product_categories)) {
            foreach ($product_categories as $i => $category_id) {
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category_id
                ]);
            }
        }

        return back();
//        return redirect()->route('admin.products')->with('success', 'Товар успешно обновлен');
    }

    public function updateSeo(Request $request)
    {
        $productId = $request->input('id');

        $seo = Product::find($productId);

        $this->authorize('update', $seo);

        if ($seo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $seo->meta_title = $request->meta_title;
        $seo->description_meta = $request->description_meta;
        $seo->keywords_meta = $request->keywords_meta;
        $seo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }

    public function updateMicroSeo(Request $request)
    {
        $productId = $request->input('id');

        $microSeo = Product::find($productId);

        $this->authorize('update', $microSeo);

        if ($microSeo === null) {
            return redirect()->back()->with('error', 'Продукт не найден.');
        }

        $microSeo->og_title_meta = $request->og_title_meta;
        $microSeo->og_description_meta = $request->og_description_meta;
        $microSeo->save();

        return redirect()->back()->with('success', 'Seo обновлено');
    }


    public function storeImage(Request $request) {
        $image_path = FileService::saveFile('uploads', "products", $request->image);
        $max_pos = ProductImage::query()->where('record_id', $request->product_id)->max('position');
        if (gettype($max_pos) !== 'integer') {
            $max_pos = 0;
        }
        $max_pos += 1;
        if($image_path) {
            $imageId = DB::table('product_images')->insertGetId([
                'path' => $image_path,
                'record_id' => $request->product_id,
                'is_active' => $request->is_active,
                'position' => $max_pos
            ]);
            if ($request->is_main == 1) {
                DB::table('products')->where('id', $request->product_id)->update([
                    'image_print_id' => $imageId
                ]);
            }
        }
        return redirect()->back()->with('success', 'Изображение создано')->with('tab_id', 'image_tab');
    }

    public function deleteImage($id) {
        DB::table('product_images')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Изображение удалено')->with('tab_id', 'image_tab');
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
        return redirect()->back()->with('success', 'Изображение успешно обновлено')->with('tab_id', 'image_tab');
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
        $product = Product::query()->find($id);

        $this->authorize('delete', $product);

        $product->delete();
        $images = DB::table('product_images')->where('id', $id)->get();
        foreach ($images as $image) {
            FileService::removeFile('uploads', 'products', $image);
        }
        DB::table('product_images')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Товар удален успешно');
    }

    public function deleteProducts(Request $request) {
        $product_ids = $request->checkbox;
        $products = Product::find($product_ids);

        $this->authorize('delete', $products);

        $products->delete();
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

    public function searchProducts(Request $request) {
        $products = Product::query()->select(['id', 'title'])->where('title', 'LIKE', '%'.$request->search.'%')->get();
        return response()->json(['products' => $products]);
    }

    public function sortImages(Request $request) {
        $images_list = $request->positions;
        foreach ($images_list as $idx=>$image_id) {
            ProductImage::query()->where('id', $image_id)->update([
                'position' => $idx + 1
            ]);
        }
    }


    public function updatePricesFromExcel(Request $request)
    {
        if (!(auth()->user()->isSuperAdmin()
            || (auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_VIEW)
                && auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_CREATE)
                && auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_EDIT)
                && auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_DELETE))))
            abort(403);

        $request->validate([
            'file' => ['required', 'file']
        ]);

        Excel::import(new ProductPricesImport, $request->file('file'));

        return back()->with('success', 'Цены обновлены');
    }

}
