<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCondition extends Model
{
    use HasFactory;


    const TYPE_SUM = 'sum';
    const TYPE_BRAND = 'brand';
    const TYPE_CATEGORY = 'category';
    const TYPE_PRODUCT = 'product';

    const ALL_TYPES = [
        self::TYPE_SUM => 'Сумма',
        self::TYPE_BRAND => 'Бренд',
        self::TYPE_CATEGORY => 'Категория',
        self::TYPE_PRODUCT => 'Товар'
    ];

    protected $fillable = [
        'type',
        'min_sum',
        'max_sum',
    ];


    protected static function booted (): void
    {

        self::deleted(function(GiftCondition $model) {
            $model->conditionCases()->delete();
            $model->conditionProducts()->delete();
        });

    }

    public function scopeBrand($query)
    {
        return $query->where('type', self::TYPE_BRAND);
    }

    public function scopeCategory($query)
    {
        return $query->where('type', self::TYPE_CATEGORY);
    }

    public function scopeProduct($query)
    {
        return $query->where('type', self::TYPE_PRODUCT);
    }



    public function conditionCases()
    {
        return $this->hasMany(GiftConditionCase::class);
    }

    public function cases(): ?\Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return match ($this->type) {
            self::TYPE_BRAND => $this->hasManyThrough(
                Brand::class,
                GiftConditionCase::class,
                'gift_condition_id',
                'id',
                'id',
                'foreign_id'
            ),
            self::TYPE_CATEGORY => $this->hasManyThrough(Category::class,
                GiftConditionCase::class,
                'gift_condition_id',
                'id',
                'id',
                'foreign_id'
            ),
            self::TYPE_PRODUCT => $this->hasManyThrough(Product::class,
                GiftConditionCase::class,
                'gift_condition_id',
                'id',
                'id',
                'foreign_id'),
            default => null,
        };
    }


    public function conditionProducts()
    {
        return $this->hasMany(GiftConditionProduct::class);
    }

    public function products()
    {
        return $this->hasManyThrough(GiftProduct::class, GiftConditionProduct::class,
            'gift_condition_id',
            'id',
        'id',
        'gift_product_id');
    }


    public function getTypeTitle()
    {
        return self::ALL_TYPES[$this->type] ?? "UNDEFINED";
    }

    public function getSumString()
    {
        if (!$this->min_sum && !$this->max_sum)
            return '∞';

        return ($this->min_sum ? ">{$this->min_sum}" : '>∞') . ' / ' . ($this->max_sum ? "<{$this->max_sum}" : '<∞');
    }

}
