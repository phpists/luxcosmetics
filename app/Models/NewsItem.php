<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'slider_type',
        'thumbnail'
    ];

    const HORIZONTAL_SLIDER = 1;

    const VERTICAL_SLIDER = 2;

    static public function getSliderTypes(): array
    {
        return [
            self::HORIZONTAL_SLIDER,
            self::VERTICAL_SLIDER,
        ];
    }

    public function mainImage()
    {
        return asset("/images/uploads/news/$this->image");
    }

    public function getThumbnailSrcAttribute()
    {
        return asset('images/uploads/news/' . $this->thumbnail);
    }

    public function images(): HasMany
    {
        return $this->hasMany(NewsImage::class, 'news_item_id');
    }

}
