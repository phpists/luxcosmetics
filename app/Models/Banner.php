<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'link',
        'status',
        'position',
        'number_position',
        'image',
        'published_at',
        'small_img'
    ];

    public function mainImage()
    {
        return asset("/uploads/banner/$this->image");
    }

    public function getSmallImage() {
        return $this->small_img !== null? $this->small_img: $this->img;
    }
}
