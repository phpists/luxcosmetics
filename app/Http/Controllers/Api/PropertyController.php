<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function getAll()
    {
        return new JsonResponse([
            'properties' => Property::all(['id', 'name'])
        ]);
    }

}
