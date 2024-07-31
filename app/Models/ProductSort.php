<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSort extends Model
{

    protected $fillable = [
        'model_type',
        'model_id',
        'product_id',
        'pos',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
