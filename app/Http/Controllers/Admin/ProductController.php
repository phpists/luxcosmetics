<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $product = new Product($request->all());
        if ($product->save()) {
            $image_path = ImageService::saveImage('uploads', "products", $request->image);
            if ($image_path !== false) {
                $image_id = DB::table('images')->insertGetId([
                    'path' => $image_path,
                    'table_name' => 'products',
                    'record_id' => $product->id
                ]);
                $product->update([
                    'image_print_id' => $image_id
                ]);
            }
        }
        return response()->redirectTo('admin.products');
    }

    public function edit(Request $request, string $id) {
        $product = Product::query()
            ->select('products.*', 'images.path as image')
            ->join('images', 'products.image_print_id', 'images.id')
            ->where('images.table_name', 'products')
            ->find($id);
        $categories = Category::query()
            ->select('id', 'name')
            ->get();
        $brands = Brand::query()
            ->select('id', 'name')
            ->get();
        $product_images = DB::table('images')
            ->where('record_id', $product->id)
            ->where('table_name', 'products')
            ->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'product_images'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::query()->find($id);
        $product->update($request->all());
    }

    public function storeImage(Request $request) {
        $image_path = ImageService::saveImage('uploads', "products", $request->image);
        if($image_path) {
            DB::table('images')->insert([
                'path' => $image_path,
                'record_id' => $request->product_id,
                'table_name' => 'products'
            ]);
        }
        return redirect()->route('admin.products.index')->with('success', 'Изображение создано');
    }

    public function deleteImage(Request $request) {
        DB::table('images')->find($request->id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Изображение удалено');
    }

    public function updateImage(Request $request) {

    }

    public function delete(Request $request, $id) {
        Product::query()->find($id)->delete();
        return redirect()->back()->with('success', 'Товар удален успешно');
    }
}
