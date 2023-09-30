<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftConditionException extends Model
{
    use HasFactory;

    const TYPE_BRAND = Brand::class;
    const TYPE_CATEGORY = Category::class;
    const TYPE_PRODUCT = Product::class;


    public $timestamps = false;

    protected $fillable = [
        'gift_condition_id',
        'type',
        'foreign_id'
    ];

    public function exceptions()
    {
        return $this->belongsTo($this->type, 'foreign_id', 'id');
    }

}
