<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alias',
        'code',
        'code_1c',
        'status',
        'price',
        'discount_price',
        'image_print_id',
        'discount_price',
        'category_id',
        'brand_id',
        'description_1',
        'description_2',
        'description_3',
        'availability',
        'created_at',
        'updated_at'
    ];

    public function getImages(): Collection
    {
        return DB::table('images')
            ->select('path')
            ->where('record_id', $this->id)
            ->where('table_name', 'products')->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function values()
    {
        return $this->belongsToMany(PropertyValue::class, 'product_property_values');
    }

}
