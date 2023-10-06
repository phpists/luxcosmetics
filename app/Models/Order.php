<?php

namespace App\Models;

use App\Mail\OrderStatusChangedMail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    use HasFactory;

    const DELIVERY_TYPE_STANDARD = 'standard';
    const DELIVERY_TYPE_EXPRESS = 'express';

    const ALL_DELIVERY_TYPES = [
        self::DELIVERY_TYPE_STANDARD => 'Стандартная',
        self::DELIVERY_TYPE_EXPRESS => 'Экспресс'
    ];


    const DELIVERY_COURIER = 'courier';
    const DELIVERY_SELF_PICKUP = 'self_pickup';


    const STATUS_NEW = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_COMPLETED = 3;


    protected $fillable = [
        'status_id',
        'user_id',
        'address_id',
        'card_id',
        'total_sum',
        'gift_box',
        'full_name',
        'phone',
        'address',
        'gift_card_id',
        'is_used_bonuses',
        'promo_code_id',
        'gift_card_discount',
        'bonuses_discount',
        'promo_code_discount',
        'bonuses_given'
    ];



    protected static function booted (): void
    {

        self::updated(function(Order $order) {
            if ($order->isDirty('status_id')) {
                Mail::to($order->user->email)->send(new OrderStatusChangedMail($order));
            }
        });

    }


    public function scopeNew($query)
    {
        return $query->where('status_id', self::STATUS_NEW);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status_id', self::STATUS_COMPLETED);
    }

    public function scopeCurrentMonth($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfMonth());
    }

    public function scopeToday($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfDay());
    }


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }


    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderProduct::class,
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function card()
    {
        return $this->belongsTo(PaymentCard::class);
    }

    public function giftCard()
    {
        return $this->belongsTo(GiftCard::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderGiftProducts()
    {
        return $this->hasMany(OrderGiftProduct::class);
    }

    public function giftProducts()
    {
        return $this->hasManyThrough(
            GiftProduct::class,
            OrderGiftProduct::class,
            'order_id',
            'id',
            'id',
            'gift_product_id'
        );
    }


    public function isUsedBonuses()
    {
        return $this->is_used_bonuses == 1;
    }



    public function getPrettyCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function isCompleted()
    {
        return $this->status_id == self::STATUS_COMPLETED;
    }

    public function getTotalDiscount()
    {
        return $this->gift_card_discount + $this->bonuses_discount + $this->promo_code_discount;
    }


}
