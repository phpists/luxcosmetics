<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{

    const TYPE_CART = 'cart';
    const TYPE_CATEGORY = 'category';
    const TYPE_PRODUCT = 'product';

    const ALL_TYPES = [
        self::TYPE_CART => 'Вся корзина',
        self::TYPE_CATEGORY => 'Категория',
        self::TYPE_PRODUCT => 'Товар'
    ];

    use HasFactory;

    protected $fillable = [
        'code',
        'quantity',
        'starts_at',
        'ends_at',
        'amount',
        'percent',
        'type',
        'category_id',
        'product_id',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date'
    ];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
