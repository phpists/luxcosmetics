<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const DELIVERY_TYPE_STANDARD = 'standard';
    const DELIVERY_TYPE_EXPRESS = 'express';

}
