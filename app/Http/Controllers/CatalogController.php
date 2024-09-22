<?php

namespace App\Http\Controllers;

use App\Enums\SeoTemplateEnum;
use App\Models\CatalogItem;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function __invoke()
    {
        return view('catalog.index', [
            'catalogItems' => CatalogItem::active()->get(),
            'seoTemplate' => SeoTemplateEnum::CATALOG->getModel(),
        ]);
    }

}
