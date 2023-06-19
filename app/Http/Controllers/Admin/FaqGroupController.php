<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqGroup;
use Illuminate\Http\Request;

class FaqGroupController extends Controller
{
    public function index()
    {
        $faq_groups = FaqGroup::orderBy('position')->paginate(20);

        $last_position = FaqGroup::max('position');
        $last_position = $last_position ? $last_position + 1 : 1;

        return view('admin.faqs.index-groups', compact('faq_groups', 'last_position'));
    }

    public function edit(Request $request, $id) {
        $group = FaqGroup::query()->find($id);
        $faqs = Faq::query()->where('group_id', $group->id)->get();
        $last_position = Faq::max('position');
        $last_position = $last_position ? $last_position + 1 : 1;
        return response()->view('admin.faqs.edit-group', compact('group', 'faqs', 'last_position'));
    }

    public function search(Request $request)
    {
        $q = $request->get('search');
        $query = FaqGroup::orderBy('position');

        if ($q) {
            $query->where('id', 'like', "%{$q}%")
                ->orWhere('question', 'like', "%{$q}%");
        }

        $faqs = $query->paginate(20);

        return response()->json(view('admin.faqs._table', compact('faqs'))->render());
    }

    public function updates_positions(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {

                $faq = FaqGroup::findOrFail($position['id']);
                $faq->position = $position['position'];
                $faq->save();
            }
        }

        $faqs = FaqGroup::pluck('position', 'id');
        return response()->json($faqs);
    }

    public function create(Request $request)
    {
        $pos = FaqGroup::query()->max('position')??1;
        return view('admin.faqs.create-group', compact('pos'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['is_active'] = array_key_exists('is_active', $data)?1:0;

        $faq = new FaqGroup($data);

        $faq->save();

        return redirect()->route('admin.faq-groups')->with('success', 'Дані збережено');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $faq = FaqGroup::query()->findOrFail($data['id']);
        $faq->update($data);
        if ($request->ajax()) {
            return response()->json(true);
        }
        return redirect()->route('admin.faqs')->with('success', 'Успешно обновлено');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $faq = FaqGroup::findOrFail($id);

        if ($faq->delete()) {
            return redirect()->route('admin.faqs')->with('success', 'Питання видалено');
        } else {
            return redirect()->route('admin.faqs')->with('warning', 'Не вдалось видалити питання');
        }
    }
}
