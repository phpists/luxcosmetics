<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function getImages(): Collection
    {
        return DB::table('images')
            ->select('path')
            ->where('record_id', $this->id)
            ->where('table_name', 'products')->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
