<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SiteConfigService;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    public function index() {
        $params = SiteConfigService::getParams();
        return view('admin.settings.config.index', compact('params'));
    }

    public function store(Request $request) {
        SiteConfigService::setParam($request->name, $request->value, $request->type);
        return redirect()->back()->with('success', 'Настройка успешно добавлена');
    }
}
