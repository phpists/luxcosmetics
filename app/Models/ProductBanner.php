<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBanner extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['product_id', 'banner_id', 'pos'];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
