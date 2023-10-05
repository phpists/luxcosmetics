<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'news_item_id',
        'position'
    ];

    public $timestamps = false;

    const IMAGE_PATH = 'news_slider';

    public function getImageSrcAttribute()
    {
        return asset("images/uploads/".self::IMAGE_PATH.'/'.$this->image_path);
    }
}
