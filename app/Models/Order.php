<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const DELIVERY_TYPE_STANDARD = 'standard';
    const DELIVERY_TYPE_EXPRESS = 'express';



    const STATUS_NEW = 1;


    protected $fillable = ['status_id', 'user_id', 'address_id', 'card_id', 'total_sum', 'delivery_type', 'gift_box',
        'as_delivery_address'];


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function card()
    {
        return $this->belongsTo(PaymentCard::class);
    }


}
