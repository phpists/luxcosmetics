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
        'updated_at',
        'show_in_discount',
        'show_in_popular',
        'show_in_new',
        'size'
    ];

    public function getImages(): Collection
    {
        return DB::table('product_images')
            ->select('path')
            ->where('record_id', $this->id)
            ->get();
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductImage::class, 'record_id');
    }

//    public function main_image()
//    {
//        $image = ProductImage::query()->where('images.id', $this->image_print_id)->first();
//        if ($image) {
//            return $image->path;
//        }
//        return null;
//    }

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

    public function filterVariations($variations) {
        if (sizeof($variations) > 0) {
            return $variations->where('parent_id', $this->id);
        }
        return $variations;
    }

    public function values()
    {
        return $this->belongsToMany(PropertyValue::class, 'product_property_values', 'product_id', 'property_value_id');
    }

    static function getVariations($product_ids): \Illuminate\Database\Eloquent\Collection|array
    {
        if (sizeof($product_ids) > 0) {
            return Product::query()
                ->select('products.*', 'product_images.path as image', 'product_variations.product_id as parent_id')
                ->join('product_images', 'products.image_print_id', 'product_images.id')
                ->join('product_variations', 'product_variations.variation_id', 'products.id')
                ->whereIn('product_variations.product_id', $product_ids)
                ->with('brand')
                ->get();
        }
        return [];
    }

}
