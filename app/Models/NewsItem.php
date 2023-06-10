<?php

namespace App\Models;

use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory;

    protected $table = 'news_item';

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
