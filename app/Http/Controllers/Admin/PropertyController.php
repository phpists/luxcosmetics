<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyCategory;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index() {
        $properties = Property::query()->paginate(15);

        $last_position = Property::query()->count();
        $last_position = $last_position ? $last_position + 1 : 1;

        $categories = Category::query()->get();

        return view('admin.properties.index', compact('properties', 'categories', 'last_position'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['show_in_filter'] = array_key_exists('show_in_filter', $data)? 1 : 0;
        $data['show_in_product'] = array_key_exists('show_in_product', $data)? 1 : 0;
        $property = new Property($data);
        if ($property->save()) {
            $sql = 'category_id in ('.implode(',', $data['category_id']).')';
            $categories = PropertyCategory::query()
                ->selectRaw('category_id, max(position) as position')
                ->havingRaw($sql)
                ->groupBy('category_id')->pluck('position', 'category_id')->toArray();

            foreach ($data['category_id'] as $idx => $category_id) {
                $position = 1;
                if (array_key_exists($category_id, $categories)) {
                    $position = $categories[$category_id] + 1;
                }
                $cat_property = new PropertyCategory([
                    'category_id' => $category_id,
                    'property_id' => $property->id,
                    'position' => $position
                ]);
                $cat_property->save();
            }
        }

        return redirect()->route('admin.properties.index');
    }

    public function create() {
        $categories = Category::query()->get();
        return view('admin.properties.create', compact('categories'));
    }

    public function edit(Request $request, $id) {
        $categories = Category::query()->get();
        $property = Property::query()->findOrFail($id);
        return view('admin.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $data['show_in_filter'] = array_key_exists('show_in_filter', $data)? 1 : 0;
        $data['show_in_product'] = array_key_exists('show_in_product', $data)? 1 : 0;
        $property = Property::query()->findOrFail($id);
        if ($property->update($data)) {
            $old_cats = $property->category_idx();
            $new_cats = array_diff($data['category_id'], $old_cats);
            $delete_cats = array_diff($old_cats, $data['category_id']);
            PropertyCategory::query()
                ->whereIn('category_id', $delete_cats)
                ->where('property_id', $property->id)->delete();
            $sql = 'category_id in ('.implode(',', $new_cats).')';

            $categories = [];
            if (sizeof($new_cats) > 0) {
                $categories= PropertyCategory::query()
                    ->selectRaw('category_id, max(position) as position')
                    ->havingRaw($sql)
                    ->groupBy('category_id')->pluck('category_id', 'position')->toArray();
            }
            foreach ($new_cats as $idx => $category_id) {
                $position = 1;
                if (array_key_exists($category_id, $categories)) {
                    $position = $categories[$category_id] + 1;
                }
                $cat_property = new PropertyCategory([
                    'category_id' => $category_id,
                    'property_id' => $property->id,
                    'position' => $position
                ]);
                $cat_property->save();
            }
        }
        return redirect()->route('admin.properties.index')->with('success', 'Характеристика успешно отредактрована');
    }

    public function delete(Request $request, $id) {
        PropertyCategory::query()->where('property_id', $id)->delete();
        Property::query()->where('id', $id)->delete();
    }

//    public function removePropertyCategory(Request $request, $id) {
//        PropertyCategory::query()->
//    }
}
