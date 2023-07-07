<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBanner;
use Illuminate\Http\Request;

class ProductBannerController extends Controller
{


    public function store(Request $request)
    {
        $product_id = $request->post('product_id');
        $banner_id = $request->post('banner_id');
        $new_pos = ProductBanner::where('product_id', $product_id)->count() + 1;

        ProductBanner::create([
            'product_id' => $product_id,
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
                $model = ProductBanner::findOrFail($position['id']);
                $model->pos = $position['position'];
                $model->save();
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');

        (ProductBanner::find($id))->delete();

        return redirect()->back();
    }

}
