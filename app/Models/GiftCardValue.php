<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_sum', 'max_sum',
        'fix_price', 'color_card'
    ];
}
