<?php

namespace App\Models;

use App\Enums\AvailableOptions;
use App\Enums\ProductPriceTypeEnum;
use App\Events\ProductBecameAvailableEvent;
use App\Services\SiteConfigService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    const TYPE_VOLUME = 1;
    const TYPE_COLOR = 2;

    const ALL_TYPES = [
        self::TYPE_VOLUME => 'Объём',
        self::TYPE_COLOR => 'Цвет'
    ];

    const PRODUCT_PRICE_CACHE_KEY = 'product_price';
    const LOYALTY_PRICE_CACHE_KEY = 'loyalty_price';

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
        'rrp',

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
        'items_left',
        'popularity',
    ];

    protected $hidden = [
        'laravel_through_key'
    ];

    protected $with = [
        'productCategories'
    ];




    protected static function booted (): void
    {

        self::updated(function(self $model) {
            if ($model->isDirty('availability')) {
                if (
                    $model->availability == AvailableOptions::AVAILABLE->value
                    && $model->getOriginal('availability') == AvailableOptions::NOT_AVAILABLE->value
                ) {
                    ProductBecameAvailableEvent::dispatch($model);
                }
            }

            if ($model->isDirty(['price', 'old_price'])) {
                $model->clearProductPriceCache();
            }
        });

    }


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

    public function imagePrint()
    {
        return $this->belongsTo(ProductImage::class, 'image_print_id');
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

    public function getVaritationsCountLabelByCount(int $count): string
    {
        return trans_choice('plurals.variants_left', $count);
    }

    public function getAllCategoriesArray(): array
    {
        return array_merge($this->productCategories->pluck('category_id')->toArray(), [$this->category_id]);
    }

    public function clearProductPriceCache(): bool
    {
        return Cache::forget(self::PRODUCT_PRICE_CACHE_KEY.'_'. $this->id);
    }

    public function getActualBonuses($bonuses)
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
        if ($value)
            return $value;

        if ($this->price != $this->rrp)
            return round((($this->rrp - $this->price) / $this->rrp) * 100);

        return 0;
    }

    public function getPriceAttribute($value)
    {
        try {
            if ($value)
                return $value;

            $user = Auth::user();

            if (!$user || !$user->loyaltyStatus?->is_over_pp) {
                $modulePrice = Cache::remember(
                    self::PRODUCT_PRICE_CACHE_KEY . '_' . $this->id,
                    now()->addHour(),
                    function () {
                        $allCategories = $this->getAllCategoriesArray();

                        $productPrice = ProductPrice::findCondition(
                            ProductPriceTypeEnum::DISCOUNT,
                            $this->brand_id,
                            $allCategories,
                            $this->id
                        );
                        if ($productPrice)
                            return $productPrice->getPrice($this->rrp);

                        return $this->rrp;
                    }
                );

                if ($modulePrice != $this->rrp)
                    return $modulePrice;
            }

            if (Auth::check()) {
                $user = Auth::user();
                $price = $this->rrp - ($this->rrp * ($user->loyalty_discount_percent / 100));
                return round($price);
            }
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $this->rrp;
    }

    public function getOldPriceAttribute($value)
    {
        if ($value)
            return $value;

        if ($this->price != $this->rrp)
            return $this->rrp;

        return null;
    }

    public function getPointsAttribute($value)
    {
        if ($value)
            return $this->getActualBonuses($value);

        if ($this->category->alias != 'sales-50') {
            $percent = (int)SiteConfigService::getParamValue('product_bonuses_percent');
            return floor(($this->price * $percent) / 100);
        }

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

    public function scopeIncludeCategory(Builder $query, int|array $categoryId)
    {
        if (!is_array($categoryId))
            $categoryId = [$categoryId];

        $query->where(function ($query) use ($categoryId) {
            $query->whereIn('products.category_id', $categoryId)
                ->orWhereHas('categories', function ($query) use ($categoryId) {
                    $query->whereIn('product_categories.category_id', $categoryId);
                });
        });
    }

    public function scopeTitleSearch(Builder $query, string $search)
    {
        $query
            ->join('brands', 'brands.id', 'brand_id')
            ->where(function ($query) use ($search) {
                foreach (explode(' ', $search) as $word) {
                    $query->where('title', 'like', '%' . $word . '%');
                };
            })->orWhere(function ($query) use ($search) {
                $query->orWhere('code', 'like', '%' . $search . '%');
            });
    }

}
