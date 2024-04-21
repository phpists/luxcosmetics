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
        $this->authorize('viewAny', Brand::class);

        $brands = Brand::query()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function search(Request $request) {
        $this->authorize('viewAny', Brand::class);

        return response()->json(Brand::query()
            ->select(['id', 'name'])
            ->where('name', 'like', '%'.$request->search.'%')->get());
    }

    public function edit(Brand $brand) {
        $this->authorize('update', $brand);

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand) {
        $this->authorize('update', $brand);

        $image = $request->image;
        $data = $request->all();
        $hideValue = $request->input('hide', null);

        if($image !== null) {
            FileService::removeFile('uploads', 'brands', $brand->image);
            $image = FileService::saveFile('uploads', 'brands', $image);
            $data['image'] = $image;
        }
        else {
            $data['image'] = $brand->image;
        }
        if ($hideValue !== "on") {
            $hideValue = null;
            $brand->update(['hide' => $hideValue]);
        }

        $brand->update($data);
        return redirect()->back()->with('success', 'Бренд успешно создан');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Brand::class);

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
        $brand = Brand::query()->where('id', $request->id)->firstOrFail();

        $this->authorize('delete', $brand);

        $brand->delete();
        return redirect()->back()->with('success', 'Бренд успешно удален');
    }

    public function show(Request $request) {
        $brand = Brand::query()->find($request->id);

        $this->authorize('view', $brand);

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
