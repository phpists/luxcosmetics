<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BestSeller\BestSellerCreate;
use App\Http\Requests\BestSeller\BestSellerStore;
use App\Http\Requests\BestSeller\BestSellerUpdate;
use App\Models\BestSeller;
use App\Services\FileService;
use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function show(Request $request)
    {
        $data = $request->all();
        $item = BestSeller::find($data['id']);

        if ($item) {
            $item->image = asset('images/uploads/best_sellers/' . $item->image);
        }

        return response()->json([
            'item' => $item,
            'route' => route('admin.best-seller.update', $item->id),
        ]);
    }

    public function store(BestSellerStore $request)
    {
        $data = $request->all();
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', "best_sellers", $request->image);
            $data['image'] = $image;
        }

        BestSeller::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'link' => $data['link'],
            'image' => $data['image']
        ]);

        return redirect()->back()->with('success', 'Данные успешно сохранены');
    }

    public function update(BestSellerUpdate $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = FileService::saveFile('uploads', "best_sellers", $request->image);
            $params['image'] = $image;
        }

        $params['title'] = $data['title'];
        $params['description'] = $data['description'];
        $params['link'] = $data['link'];

        BestSeller::where('id', $data['id'])->update($params);

        return redirect()->back()->with('success', 'Данные успешно отредактированы');
    }

    public function destroy(Request $request, $id)
    {
        $item = BestSeller::find($id);

        if ($item){
            $item->delete();
        }

        return redirect()->back()->with('success', 'Данные успешно удалены');
    }
}
