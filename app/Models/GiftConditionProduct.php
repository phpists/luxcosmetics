<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftConditionProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['gift_condition_id', 'gift_product_id'];

}
