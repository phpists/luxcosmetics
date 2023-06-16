<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyValue;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{

    public function store(Request $request)
    {
        $property_id = $request->post('property_id');
        $value = $request->post('value');

        $property_value = PropertyValue::create(compact('property_id', 'value'));

        if ($request->ajax()) {
            return response()->json($property_value);
        }

        return back()->with('success', 'Значение успешно сохранено');
    }

    public function update(Request $request)
    {
        $id = $request->post('id');
        $value = $request->post('value');

        $property_value = PropertyValue::find($id);
        $property_value->value = $value;

        return $property_value->save();
    }

    public function drop(Request $request)
    {
        $id = $request->post('id');

        return (PropertyValue::find($id))->delete();
    }

}
