<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    const SUPPORT_ITEMS = 1;

    const SIMILAR_ITEMS = 2;

    protected $fillable = ['product_id', 'relative_product_id', 'relation_type'];

    public static function getRelationName($relation_type) {
        return match ($relation_type) {
            self::SUPPORT_ITEMS => 'Сопутствующие товары',
            self::SIMILAR_ITEMS => 'Похожие товары',
        };
    }

    public function related_product(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Product::class, 'id', 'relative_product_id');
    }
}
