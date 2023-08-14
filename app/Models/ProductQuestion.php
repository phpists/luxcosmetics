<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'status'];

    public function messages(): HasMany
    {
        return $this->hasMany(ProductQuestionMessage::class, 'question_id');
    }
}
