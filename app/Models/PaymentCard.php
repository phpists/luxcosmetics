<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'cvv', 'card_number', 'valid_date', 'full_name', 'is_default'];
}
