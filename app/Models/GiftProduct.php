<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftProduct extends Model
{
    use HasFactory;


    const IMAGES_PATH = 'gift_products';


    protected $fillable = [
        'brand_id',
        'article',
        'title',
        'img',
        'is_available'
    ];

    protected $hidden = [
        'laravel_through_key'
    ];

    protected static function booted (): void
    {

        self::deleted(function(GiftProduct $model) {
            FileService::removeFile('uploads', self::IMAGES_PATH, $model->img);
        });

    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function isAvailable(): bool
    {
        return $this->is_available == 1;
    }

    public function getImgSrc()
    {
        return asset("images/uploads/" . $this::IMAGES_PATH . '/' . $this->img);
    }

}
