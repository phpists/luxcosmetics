<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoDataRequest;
use App\Models\SeoData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SeoDataController extends Controller
{
    public function edit(SeoData $seoData)
    {
        return view('admin.seo-data.edit', [
            'seoData' => $seoData
        ]);
    }

    public function update(SeoDataRequest $request, SeoData $seoDatum)
    {
        try {
            $seoDatum->update($request->validated());

            return Response::json([
                'message' => 'SEO обновлено'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return Response::json(['message' => 'ОШИБКА'], 500);
    }
}
