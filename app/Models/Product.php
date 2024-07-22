<?php

namespace App\Models;

use App\Enums\AvailableOptions;
use App\Enums\ProductPriceTypeEnum;
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
        self::TYPE_VOLUME => 'Объём',
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

        'meta_title',
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

    protected $hidden = [
        'laravel_through_key'
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
        $image = $this->images->where('id', $this->image_print_id)->first();
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

    public function propertyValues()
    {
        return $this->hasMany(ProductPropertyValue::class);
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

    public function basePropertyValue()
    {
        return $this->hasOneThrough(
            PropertyValue::class,
            ProductPropertyValue::class,
            'product_id',
            'id',
            'id',
            'property_value_id'
        )->orderBy('property_id');
    }

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

    public function publishedComments()
    {
        return $this->comments()->published();
    }

    public function hasBonuses()
    {
        return $this->points > 0;
    }

    public function isAvailable(): bool
    {
        return $this->items_left > 0;
    }

    public function related_products()
    {
        return $this->hasMany(RelatedProduct::class, 'product_id');
    }

    public function similarProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'relative_product_id')->where('relation_type', RelatedProduct::SIMILAR_ITEMS);
    }

    public function supportProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'relative_product_id')->where('relation_type', RelatedProduct::SUPPORT_ITEMS);
    }

    public function getPropertyValues()
    {
        return $this->values->map(function ($value) {
            $productPropertyValueIds = ProductPropertyValue::whereProductId($this->id)
                ->wherePropertyId($value->property_id)
                ->pluck('property_value_id');

            $allValues = implode('; ', PropertyValue::whereIn('id', $productPropertyValueIds)->pluck('value')->toArray());
            $value->value = $allValues;

            return $value;
        })->unique('property_id');
    }

    public function getVaritationsCountLabel(): string
    {
        $variants = \App\Services\CatalogService::getProductVariations($this->id, $this->base_property_id);
        $count = $variants->count();
        return trans_choice('plurals.variants_left', $count);
    }

    public function getAllCategoriesArray(): array
    {
        return array_merge($this->productCategories()->select('category_id')->pluck('category_id')->toArray(), [$this->category_id]);
    }


    private function getActualPrice($price)
    {
        try {
//            return \Cache::remember('product_price_'. $this->id, now()->addHour(), function () use ($price) {
                $allCategories = $this->getAllCategoriesArray();
                $productPrice = ProductPrice::findCondition(ProductPriceTypeEnum::DISCOUNT, $this->brand_id, $allCategories, $this->id);

                if ($productPrice)
                    return $productPrice->getPrice($price);

                return $price;
//            });
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $price;
    }

    private function getActualBonuses($bonuses)
    {
        try {
            $allCategories = $this->getAllCategoriesArray();
            $productPrice = ProductPrice::findCondition(ProductPriceTypeEnum::BONUSES, $this->brand_id, $allCategories, $this->id);

            if ($productPrice)
                return $productPrice->getBonuses($bonuses);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $bonuses;
    }

    private function getActualOldPrice($value)
    {
        if ($this->raw_price != $this->price) {
            return $this->raw_price;
        }

        return $value;
    }

    public function getDiscountAttribute($value)
    {
        if ($this->old_price)
            return round((($this->old_price - $this->price) / $this->old_price) * 100);

        return $value;
    }

    public function getPriceAttribute($value)
    {
        return $this->getActualPrice($value);
    }

    public function getOldPriceAttribute($value)
    {
        if ($value || ($this->price != $this->raw_price))
            return $this->getActualOldPrice($value);

        return null;
    }

    public function getPointsAttribute($value)
    {
        if ($value || ($this->price != $this->raw_price))
            return $this->getActualBonuses($value);

        return null;
    }

    public function getRawPriceAttribute($value)
    {
        return $this->attributes['price'];
    }

    public function getRawOldPriceAttribute($value)
    {
        return $this->attributes['old_price'];
    }

    public function getRawPointsAttribute($value)
    {
        return $this->attributes['points'];
    }

    public function getRawDiscountAttribute($value)
    {
        return $this->attributes['discount'];
    }

}
