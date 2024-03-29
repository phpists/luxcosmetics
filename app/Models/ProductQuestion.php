<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductQuestion extends Model
{
    use HasFactory;

    const NEW = 1;

    const PUBLISHED = 2;

    const CLOSED = 3;

    const ITEMS_PER_PAGE = 4;

    protected $fillable = ['product_id', 'status'];

    public function scopeNew(Builder $query): void
    {
        $query->where('status', self::NEW);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ProductQuestionMessage::class, 'question_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
