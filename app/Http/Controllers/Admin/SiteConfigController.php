<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Services\SiteConfigService;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    public function index() {
        if (!(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_VIEW)))
            abort(403);

        $params = SiteConfigService::getParams();
        return view('admin.settings.config.index', compact('params'));
    }

    public function store(Request $request) {
        if (!(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_MANAGE)))
            abort(403);

        SiteConfigService::setParam($request->name, $request->value, $request->type);
        return redirect()->back()->with('success', 'Настройка успешно добавлена');
    }
}
