<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index() {
        $products = Product::query()->get();
        return response()->view('admin.products.index', compact('products'));
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
        $product = new Product($data);
        if ($product->save()) {
            $image_path = ImageService::saveImage('uploads', "products", $request->image);
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
        $product_variations = Product::query()
            ->select('products.id as id', 'products.title as title')
            ->join('product_variations', 'product_variations.variation_id', 'products.id')
            ->where('product_variations.product_id', $product->id)
            ->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'product_images', 'product_variations'));
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        $product = Product::query()->findOrFail($id);
        $data = $request->all();
        $data['show_in_discount'] = array_key_exists('show_in_discount', $data)? 1: 0;
        $data['show_in_popular'] = array_key_exists('show_in_popular', $data)? 1: 0;
        $data['show_in_new'] = array_key_exists('show_in_new', $data)? 1: 0;
        $product->update($data);
        $variations_id = $request->variations_id??[];
        $product_variations = [];
        foreach ($variations_id as $variation_id) {
            $product_variations[] = [
                'variation_id' => $variation_id,
                'product_id' => $product->id
            ];
        }
        ProductVariation::query()->where('product_id', $product->id)->delete();
        ProductVariation::query()->insert($product_variations);
        return redirect()->route('admin.products')->with('success', 'Товар успешно обновлен');
    }

    public function storeImage(Request $request) {
        $image_path = ImageService::saveImage('uploads', "products", $request->image);
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
        Log::info($request->is_main);
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
}
