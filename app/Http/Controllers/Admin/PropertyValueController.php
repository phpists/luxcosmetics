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
        $value = trim($request->post('value'));

        if ($value) {
            $property_value = PropertyValue::create(compact('property_id', 'value'));

            if ($request->ajax()) {
                return response()->json($property_value);
            }

            return back()->with('success', 'Значение успешно сохранено');
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Значение не может быть пустым'], 422);
        }

        return back()->with('error', 'Значение не может быть пустым');
    }

    public function update(Request $request)
    {
        $id = $request->post('id');
        $value = $request->post('value');
        $color = $request->post('color');

        $property_value = PropertyValue::find($id);
        $property_value->value = $value;
        $property_value->color = $color;

        return $property_value->save();
    }

    public function drop(Request $request)
    {
        $id = $request->post('id');

        return (PropertyValue::find($id))->delete();
    }

}
