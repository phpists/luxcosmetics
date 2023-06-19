<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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
        return asset("/uploads/news/$this->image");
    }
}
