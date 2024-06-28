<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoTemplate;
use Illuminate\Http\Request;

class SeoTemplateController extends Controller
{

    public function index()
    {
        return view('admin.seo-templates.index', [
            'seoTemplates' => SeoTemplate::all()
        ]);
    }

    public function show(Request $request, SeoTemplate $seoTemplate)
    {
        return $seoTemplate;
    }

    public function update(Request $request, SeoTemplate $seoTemplate)
    {
        $seoTemplate->update($request->only(['title', 'description']));

        return to_route('admin.seo-templates.index')->with('success', 'Шаблон успешно обновлен');
    }

}
