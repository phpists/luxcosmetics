<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'content',
        'title',
        'link',
        'image_path',
        'category_id',
        'is_active'
    ];

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
