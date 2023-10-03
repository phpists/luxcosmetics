<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    const ITEMS_PER_PAGE = 4;

    const NEW = 'Новый';

    protected $fillable = [
        'rating',
        'product_id',
        'description',
        'name',
        'email',
        'status'
    ];

    public function scopeNew(Builder $query): void
    {
        $query->where('status', self::NEW);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
