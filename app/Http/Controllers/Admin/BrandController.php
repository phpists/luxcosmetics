<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::query()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function update(Request $request) {
        $brand = Brand::query()->findOrFail($request->id);
        $image = $request->image;
        $data = $request->all();
        if($image !== null) {
            FileService::removeFile('uploads', 'brands', $brand->image);
            $image = FileService::saveFile('uploads', 'brands', $image);
            $data['image'] = $image;
        }
        else {
            $data['image'] = $brand->image;
        }
        $brand->update($data);
        return redirect()->back()->with('success', 'Бренд успешно создан');
    }

    public function store(Request $request)
    {
        $image = $request->image;
        if ($image !== null) {
            $image = FileService::saveFile('uploads', 'brands', $image);
        }

        $data = $request->all();
        $data['image'] = $image;

        $brand = new Brand($data);
        $brand->link = Str::slug($brand->name);
        $brand->save();

        return redirect()->back()->with('success', 'Бренд успешно создан');
    }

    public function delete(Request $request) {
        Brand::query()->where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Бренд успешно удален');
    }

    public function show(Request $request) {
        $brand = Brand::query()->find($request->id);
        if (!$brand) {
            return response()->json([
                'status' => false, 'message' => 'Запись не найдена'
            ], 404);
        }
        else {
            return response()->json($brand);
        }
    }

    public function deleteImage($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->image) {
            $imagePath = public_path('/images/uploads/brands/' . $brand->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);

                $brand->image = null;
                $brand->save();
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false]);
    }

}
