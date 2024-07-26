<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSort;
use Illuminate\Http\Request;

class CategoryProductSortController extends Controller
{

    public function store(Request $request)
    {
        ProductSort::create($request->all());
        return redirect()->back();
    }

    public function updatePositions(Request $request)
    {
        $positions = $request->post('positions');
        if ($positions) {
            foreach ($positions as $position) {
                $model = ProductSort::findOrFail($position['id']);
                $model->pos = $position['position'];
                $model->save();
            }
        }
    }

    public function destroy(Request $request, ProductSort $categoryProductSort)
    {
        $categoryProductSort->delete();
        return redirect()->back();
    }

}
