<?php

namespace App\Models;

use App\Enums\AvailableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    const TYPE_VOLUME = 1;
    const TYPE_COLOR = 2;

    const ALL_TYPES = [
        self::TYPE_VOLUME => 'Объем',
        self::TYPE_COLOR => 'Цвет'
    ];

    protected $fillable = [
        'title',
        'alias',
        'code',
        'code_1c',
        'status',
        'price',
        'old_price',
        'discount',
        'image_print_id',
        'discount_price',
        'category_id',
        'base_property_id',
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
        'show_in_sales_page',
        'show_in_percent_discount_page',
        'show_in_new_page',
        'size',
        'points',

        'description_meta',
        'keywords_meta',
        'og_title_meta',
        'og_description_meta',

        'height_product',
        'width_product',
        'length_product',
        'weight_product',
        'description_4',
        'country_products',
        'storage_conditions',
        'allergy',
        'spyrt',
        'expiry_date',
        'items_left'
    ];

    public function getImages(): Collection
    {
        return DB::table('product_images')
            ->select('id', 'path')
            ->where('record_id', $this->id)
            ->orderBy('position')
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

    public function getMainImageAttribute()
    {
        $image = ProductImage::query()->where('id', $this->image_print_id)->first();
        if ($image) {
            return $image->path;
        }
        return null;
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

    public function baseProperty()
    {
        return $this->hasOne(Property::class, 'id', 'base_property_id');
    }

//    public function baseValue()
//    {
//        return $this->hasOneThrough(
//            PropertyValue::class,
//            ProductPropertyValue::class,
//            'product_id', // Зовнішній ключ в проміжній таблиці, що посилається на products.id
//            'id', // Зовнішній ключ в моделі PropertyValue, що посилається на product_property_values.property_value_id
//            'base_property_id', // Локальний ключ в таблиці products, який посилається на property_id в проміжній таблиці
//            'property_value_id' // Локальний ключ в проміжній таблиці, який посилається на property_values.id
//        )
//            ->where('product_property_values.property_id', 'products.base_property_id');
//    }

    public function getBaseValueAttribute()
    {
        return $this->values()
            ->where('property_value.property_id', $this->base_property_id)
            ->first();
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

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, ProductCategory::class);
    }

    public function relative_products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'id', 'relative_product_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function hasBonuses()
    {
        return $this->points > 0;
    }

    public function isAvailable(): bool
    {
        return $this->items_left > 0;
    }

    public function similarProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'relative_product_id')->where('relation_type', RelatedProduct::SIMILAR_ITEMS);
    }

    public function supportProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'relative_product_id')->where('relation_type', RelatedProduct::SUPPORT_ITEMS);
    }

}
