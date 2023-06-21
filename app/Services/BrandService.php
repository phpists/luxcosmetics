<?php

namespace App\Services;

use App\Models\Brand;


class BrandService
{
    public static function getBrand()
{
    $brand = Brand::select('brands.*');
    return $brand;
}

}

