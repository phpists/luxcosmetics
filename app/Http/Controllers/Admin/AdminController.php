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
        return view('admin.dashboard.dashboard');
    }

    public function dashboard(Request $request)
    {
        return view('admin.dashboard.dashboard');
    }
}
