<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class LoyaltyStatus extends Model
{
    protected $fillable = [
        'title',
        'achieve_sum',
        'discount_percent',
        'is_over_pp',
    ];

    protected $casts = [
        'is_over_pp' => 'boolean',
    ];

    public function fullTitle(): Attribute
    {
        return Attribute::get(fn () => $this->title .' | '. $this->discount_percent .'% | от '. $this->achieve_sum);
    }
}
