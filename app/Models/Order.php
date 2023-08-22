<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const DELIVERY_TYPE_STANDARD = 'standard';
    const DELIVERY_TYPE_EXPRESS = 'express';



    const STATUS_NEW = 1;


    protected $fillable = [
        'status_id',
        'user_id',
        'address_id',
        'card_id',
        'total_sum',
        'delivery_type',
        'gift_box',
        'as_delivery_address',
        'full_name',
        'phone',
        'city',
        'region',
        'address',
        'discount',
        'gift_card_id',
        'promo_code_id',
        'is_used_bonuses',
    ];


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
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

    public function isUsedBonuses()
    {
        return $this->is_used_bonuses == 1;
    }



    public function getStatusTitleAttribute()
    {
        return 'Новый'; // TODO: створити сутність статусів
    }

    public function getPrettyCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }


}
