<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogItem extends Model
{
    use HasFactory;

    protected $table = 'blog_items';

    protected $fillable = [
        'title',
        'text',
        'link',
        'status',
        'image',
        'published_at',
    ];

    public function mainImage()
    {
        return asset("/uploads/blog/$this->image");
    }
}
