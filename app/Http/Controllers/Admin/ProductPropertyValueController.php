<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductPropertyValue;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Http\Request;

class ProductPropertyValueController extends Controller
{

    public function store(Request $request)
    {
        $product_id = $request->post('product_id');
        $property_value_ids = $request->post('property_value_ids');
        $property_id = $request->post('property_id');

        if (in_array(0, $property_value_ids)) {
            $property = Property::find($property_id);
        } else {
            $property_value = PropertyValue::find($property_value_ids[0]);
            $property = $property_value->property;
        }

        $all_property_values_ids = $property
            ->values()
            ->pluck('id');

        ProductPropertyValue::where('product_id', $product_id)
            ->whereIn('property_value_id', $all_property_values_ids)
            ->delete();

        if (in_array(0, $property_value_ids) && count($property_value_ids) < 2)
            return response()->json(['result' => true]);

        $result = [];

        foreach ($property_value_ids as $property_value_id) {
            $result[] = ProductPropertyValue::create([
                'product_id' => $product_id,
                'property_id' => $property_value->property_id,
                'property_value_id' => $property_value_id
            ]);
        }

        return response()->json($result);
    }

}
