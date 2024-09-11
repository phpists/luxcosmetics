<?php

namespace App\Models;

use App\Enums\ProductPriceTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ProductPrice extends Model
{

    protected $fillable = [
        'title',
        'is_active',
        'start_date',
        'end_date',
        'type',
        'amount',
        'rounding',
        'pos'
    ];


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('positionSorted', function (Builder $builder) {
            $builder->orderBy('pos');
        });

        self::created(function(self $model) {
            $model->clearProductsPriceCache();
        });
        self::updated(function(self $model) {
            $model->clearProductsPriceCache();
        });
        self::deleted(function(self $model) {
            $model->clearProductsPriceCache();
        });
    }

    private function clearProductsPriceCache(): void
    {
        foreach ($this->caseProducts as $caseProduct) {
            $caseProduct->product->clearProductPriceCache();
        }
        foreach ($this->caseBrands as $caseBrand) {
            foreach ($caseBrand->brand->products as $caseBrandProduct) {
                $caseBrandProduct->clearProductPriceCache();
            }
        }
        foreach ($this->caseCategories as $caseCategory) {
            foreach ($caseCategory->category->products as $caseCategoryProduct) {
                $caseCategoryProduct->clearProductPriceCache();
            }
        }
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeActual($query)
    {
        return $query->where(function ($query) {
            $query->whereNull('start_date')
                ->orWhere('start_date', '<=', now());
        })->where(function ($query) {
            $query->whereNull('end_date')
                ->orWhere('end_date', '>=', now());
        });
    }

    public function scopeDiscount($query)
    {
        return $query->whereType(ProductPriceTypeEnum::DISCOUNT);
    }


    public function scopeBonuses($query)
    {
        return $query->whereType(ProductPriceTypeEnum::BONUSES);
    }


    public function cases(): HasMany
    {
        return $this->hasMany(ProductPriceCase::class);
    }

    public function caseBrands(): HasMany
    {
        return $this->cases()
            ->whereModelType(Brand::class);
    }

    public function caseCategories(): HasMany
    {
        return $this->cases()
            ->whereModelType(Category::class);
    }

    public function caseProducts(): HasMany
    {
        return $this->cases()
            ->whereModelType(Product::class);
    }

    public function excepts(): HasMany
    {
        return $this->hasMany(ProductPriceException::class);
    }

    public function exceptBrands(): HasMany
    {
        return $this->excepts()
            ->whereModelType(Brand::class);
    }

    public function exceptCategories(): HasMany
    {
        return $this->excepts()
            ->whereModelType(Category::class);
    }

    public function exceptProducts(): HasMany
    {
        return $this->excepts()
            ->whereModelType(Product::class);
    }


    public function getTypeTitle(): string
    {
        return ProductPriceTypeEnum::from($this->type)->getTitle();
    }

    public function getDateString(): string
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date . ' > ' . $this->end_date;
        } elseif ($this->start_date) {
            return 'От ' . $this->start_date;
        } elseif ($this->end_date) {
            return 'До ' . $this->end_date;
        } else {
            return '∞';
        }
    }


    public static function findCondition(ProductPriceTypeEnum $priceTypeEnum, int $brand_id, array $categories_id, int $product_id): ?self
    {
        return self::query()
            ->whereType($priceTypeEnum->value)
            ->active()
            ->actual()
            ->where(function ($query) use ($brand_id, $categories_id, $product_id) {
                $query->whereHas('caseBrands', function ($query) use ($brand_id) {
                    return $query->whereModelId($brand_id);
                })->orWhereHas('caseCategories', function ($query) use ($categories_id) {
                    return $query->whereIn('model_id', $categories_id);
                })->orWhereHas('caseProducts', function ($query) use ($product_id) {
                    return $query->whereModelId($product_id);
                });
            })
            ->where(function ($query) use ($brand_id, $categories_id, $product_id) {
                $query->whereDoesntHave('exceptBrands', function ($query) use ($brand_id) {
                    return $query->whereModelId($brand_id);
                })->whereDoesntHave('exceptCategories', function ($query) use ($categories_id) {
                    return $query->whereIn('model_id', $categories_id);
                })->whereDoesntHave('exceptProducts', function ($query) use ($product_id) {
                    return $query->whereModelId($product_id);
                });
            })
            ->first();
    }

    public function getPrice(int $price)
    {
        if ($this->type == ProductPriceTypeEnum::DISCOUNT->value) {
            $price = $price - ($price * ($this->amount / 100));

            if ($this->rounding != 0) {
                $price = ceil($price / $this->rounding) * $this->rounding;;
            }

            return $price;
        }

        return $price;
    }

    public function getBonuses(int $bonuses)
    {
        if ($this->type == ProductPriceTypeEnum::BONUSES->value) {
            $bonuses = $bonuses * $this->amount;

            if ($this->rounding != 0) {
                $bonuses = ceil($bonuses / $this->rounding) * $this->rounding;;
            }

            return $bonuses;
        }

        return $bonuses;
    }

}
