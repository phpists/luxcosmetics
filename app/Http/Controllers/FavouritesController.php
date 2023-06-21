<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    public function index() {
        return view('favourite-products');
    }
}
