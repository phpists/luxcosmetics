<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyValue extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'property_id', 'property_value_id'];

    public function property(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Property::class);
    }

}
