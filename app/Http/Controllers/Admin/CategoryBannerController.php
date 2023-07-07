<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryBanner;
use Illuminate\Http\Request;

class CategoryBannerController extends Controller
{


    public function store(Request $request)
    {
        $category_id = $request->post('category_id');
        $banner_id = $request->post('banner_id');
        $new_pos = CategoryBanner::where('category_id', $category_id)->count() + 1;

        CategoryBanner::create([
            'category_id' => $category_id,
            'banner_id' => $banner_id,
            'pos' => $new_pos
        ]);

        return redirect()->back();
    }

    public function sort(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $model = CategoryBanner::findOrFail($position['id']);
                $model->pos = $position['position'];
                $model->save();
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');

        (CategoryBanner::find($id))->delete();

        return redirect()->back();
    }


}
