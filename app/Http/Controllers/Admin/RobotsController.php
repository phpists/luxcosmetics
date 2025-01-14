<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class RobotsController extends Controller
{
    public function index()
    {
        abort_if(!(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ROBOTS_VIEW)), 403);

        return view('admin.robots.index', [
            'content' => File::get(public_path('robots.txt')),
        ]);
    }

    public function update(Request $request)
    {
        abort_if(!(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ROBOTS_EDIT)), 403);

        $result = File::put(public_path('robots.txt'), $request->input('content'));

        if ($result)
            Session::flash('success', 'robots.txt успешно сохранен');

        return redirect()->route('admin.robots.index');
    }
}
