<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqLang;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('position')->paginate(20);

        $last_position = Faq::max('position');
        $last_position = $last_position ? $last_position + 1 : 1;

        return view('admin.faqs.index', compact('faqs', 'last_position'));
    }

    public function search(Request $request)
    {
        $q = $request->get('search');
        $query = Faq::orderBy('position');

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

                $faq = Faq::findOrFail($position['id']);
                $faq->position = $position['position'];
                $faq->save();
            }
        }

        $faqs = Faq::pluck('position', 'id');
        return response()->json($faqs);
    }

    public function show(Request $request)
    {
        $faq = Faq::find($request->get('id'));

        return $faq;
    }

    public function store(Request $request)
    {
        $faq = new Faq($request->all());

        $faq->save();

        return redirect()->route('admin.faqs')->with('success', 'Дані збережено');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $faq = Faq::query()->findOrFail($data['id']);
        $faq->update($data);
        if ($request->ajax()) {
            return response()->json(true);
        }
        return redirect()->route('admin.faqs')->with('success', 'Дані збережено');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $faq = Faq::findOrFail($id);

        if ($faq->delete()) {
            return redirect()->route('admin.faqs')->with('success', 'Питання видалено');
        } else {
            return redirect()->route('admin.faqs')->with('warning', 'Не вдалось видалити питання');
        }
    }

}
