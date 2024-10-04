<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductPriceCase extends Model
{

    protected $fillable = [
        'product_price_id',
        'model_id',
        'model_type',
    ];

    public function product()
    {
        return $this->morphTo(Product::class);
    }

    public function brand()
    {
        return $this->morphTo(Brand::class);
    }

    public function category()
    {
        return $this->morphTo(Category::class);
    }

}
