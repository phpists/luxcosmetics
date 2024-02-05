<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierDeliveryMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'delivery_method_id',
        'prefix',
        'countries',
        'states',
        'cities',
    ];

    protected $casts = [
        'countries' => 'array',
        'states' => 'array',
        'cities' => 'array'
    ];

    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

}
