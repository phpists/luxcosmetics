<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!(Auth::check() && $user->isAdmin())) {
            return view('admin.auth.login');
        }
        $product_questions = ProductQuestion::query()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return view('admin.dashboard.dashboard', compact('product_questions'));
    }

    public function dashboard(Request $request)
    {
        return redirect(route('admin.home'));
    }

    public function downloadProductJson(Request $request)
    {
        $data = ProductResource::collection(Product::query()->limit(10)->get())->response()->getData(true);
        $jsonContent = json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        return response()->streamDownload(function () use ($jsonContent) {
            echo $jsonContent;
        }, 'test.json');
    }
}
