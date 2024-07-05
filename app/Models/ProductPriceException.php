<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductPriceException extends Model
{

    protected $fillable = [
        'product_price_id',
        'model_id',
        'model_type',
    ];

}
