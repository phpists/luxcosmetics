<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BestSeller;
use App\Models\HomeMainSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['tab_id'] = 'tab_1';
        $data['bestSeller'] = BestSeller::all();
        $data['homeMainSlider'] = HomeMainSlider::all();

        return view('admin.home.index', $data);
    }
}
