<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromoCode extends Model
{

    const TYPE_CART = 'cart';
    const TYPE_CATEGORY = 'category';
    const TYPE_PRODUCT = 'product';
    const TYPE_BRAND = 'brand';

    const ALL_TYPES = [
        self::TYPE_CART => 'Вся корзина',
        self::TYPE_CATEGORY => 'Категория',
        self::TYPE_PRODUCT => 'Товар',
        self::TYPE_BRAND => 'Бренд',
    ];

    protected $fillable = [
        'code',
        'quantity',
        'starts_at',
        'ends_at',
        'amount',
        'percent',
        'type',
        'min_sum',
        'calc_on_base',
        'uses_per_user',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
        'calc_on_base' => 'bool'
    ];


    public function scopeActive($query)
    {
        $currentDate = now()->toDateString();

        return $query->where(function ($q) {
            $q->whereNull('quantity')
                ->orWhere('uses', '<', DB::raw('quantity'));
        })->where(function ($q) use ($currentDate) {
            $q->whereNull('starts_at')
                ->orWhere('starts_at', '<=', $currentDate);
        })->where(function ($q) use ($currentDate) {
            $q->whereNull('ends_at')
                ->orWhere('ends_at', '>=', $currentDate);
        });
    }

    public function scopeAvailableForUser(Builder $query, ?int $userId = null): void
    {
        $userId = $userId ?? Auth::id();

        $query->where(function ($q) use ($userId) {
            $q->whereNull('uses_per_user') // Необмежені промокоди
            ->orWhereDoesntHave('orders', function ($subQuery) use ($userId) {
                $subQuery->where('orders.user_id', $userId)
                    ->groupBy('orders.promo_code_id')
                    ->havingRaw('COUNT(orders.id) >= promo_codes.uses_per_user');
            });
        });
    }

    public function isAvailableForUser(int $userId): bool
    {
        if (is_null($this->uses_per_user))
            return true; // необмежений

        $usageCount = $this->orders()->where('user_id', $userId)->count();
        return $usageCount < $this->uses_per_user;
    }


    public function cases(): HasMany
    {
        return $this->hasMany(PromoCodeCase::class);
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isProductIncluded(int $productId): bool
    {
        return match ($this->type) {
            self::TYPE_CART => true,
            self::TYPE_CATEGORY => Product::whereId($productId)->includeCategory($this->caseCategories()->pluck('model_id')->values()->toArray())->exists(),
            self::TYPE_PRODUCT => in_array($productId, $this->caseProducts()->pluck('model_id')->values()->toArray()),
            self::TYPE_BRAND => Product::whereId($productId)->whereIn('brand_id', $this->caseBrands()->pluck('model_id')->values()->toArray())->exists(),
        };
    }

    public function calculateProductPrice(int|float $price)
    {
        if ($this->amount) {
            $price -= $this->amount;
        } elseif ($this->percent) {
            $price -= $price * ($this->percent / 100);
        }

        return $price;
    }

}
