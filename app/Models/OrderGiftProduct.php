<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGiftProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['order_id', 'gift_product_id'];

}
