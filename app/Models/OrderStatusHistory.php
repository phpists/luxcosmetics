<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $fillable = [
        'order_id',
        'order_status_id',
    ];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
