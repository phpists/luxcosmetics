<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (Auth::check() && $user->isAdmin()) {
            return view('admin.dashboard.dashboard');
        }
        return view('admin.auth.login');
    }

    public function dashboard(Request $request)
    {
        return view('admin.dashboard.dashboard');
    }
}
