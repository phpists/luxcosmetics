<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum', 'color',
        'receiver', 'receiver_email',
        'from_whom', 'description'
    ];
}
