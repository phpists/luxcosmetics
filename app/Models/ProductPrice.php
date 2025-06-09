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
        'is_exclusion',
        'start_date',
        'end_date',
        'type',
        'amount',
        'rounding',
        'pos',
        'calc_on_base',
    ];

    protected $casts = [
        'calc_on_base' => 'bool'
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

        self::saved(function (self $model) {
            $model->clearProductsPriceCache();
        });
        self::deleting(function (self $model) {
            $model->clearProductsPriceCache();
        });
    }

    private function clearProductsPriceCache(): void
    {
        if ($this->caseProducts) {
            foreach ($this->caseProducts as $caseProduct) {
                $caseProduct->model->clearProductPriceCache();
            }
        }

        if ($this->caseBrands) {
            foreach ($this->caseBrands as $caseBrand) {
                foreach ($caseBrand->model->products as $caseBrandProduct) {
                    $caseBrandProduct->clearProductPriceCache();
                }
            }
        }

        if ($this->caseCategories) {
            foreach ($this->caseCategories as $caseCategory) {
                foreach ($caseCategory->model->products as $caseCategoryProduct) {
                    $caseCategoryProduct->clearProductPriceCache();
                }
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

    public static function getAllNestedCategoryIds(array $ids): array
    {
        $all = collect($ids);

        $stackDown = $ids;
        while (!empty($stackDown)) {
            $children = Category::whereIn('category_id', $stackDown)->pluck('id')->all();
            $stackDown = $children;
            $all = $all->merge($children);
        }

        $stackUp = $ids;
        while (!empty($stackUp)) {
            $parents = Category::whereIn('id', $stackUp)->pluck('category_id')->filter()->all();
            $stackUp = $parents;
            $all = $all->merge($parents);
        }

        return $all->unique()->values()->all();
    }


    public static function findCondition(ProductPriceTypeEnum $priceTypeEnum, int $brand_id, array $categories_id, int $product_id): ?self
    {
        $allCategoryIds = self::getAllNestedCategoryIds($categories_id);

        return self::query()
            ->whereType($priceTypeEnum->value)
            ->active()
            ->actual()
            ->where(function ($query) use ($brand_id, $allCategoryIds, $product_id) {
                $query->where(function ($q) use ($brand_id, $allCategoryIds, $product_id) {
                    $q->where('is_exclusion', 1)
                        ->whereDoesntHave('exceptBrands', fn($q) => $q->whereModelId($brand_id))
                        ->whereDoesntHave('exceptCategories', fn($q) => $q->whereIn('model_id', $allCategoryIds))
                        ->whereDoesntHave('exceptProducts', fn($q) => $q->whereModelId($product_id));
                })
                    ->orWhere(function ($q) use ($brand_id, $allCategoryIds, $product_id) {
                        $q->where('is_exclusion', 0)
                            ->where(function ($sub) use ($brand_id, $allCategoryIds, $product_id) {
                                $sub->whereHas('caseBrands', fn($q) => $q->whereModelId($brand_id))
                                    ->orWhereHas('caseCategories', fn($q) => $q->whereIn('model_id', $allCategoryIds))
                                    ->orWhereHas('caseProducts', fn($q) => $q->whereModelId($product_id));
                            });
                    });
            })
            ->orderByDesc('is_exclusion')
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
