<?php

namespace App\Models;

use App\Traits\Models\HasCatalogBanners;
use App\Traits\Models\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasTags, HasCatalogBanners;

    protected $fillable = ['name', 'image', 'link', 'hide', 'seo_content'];

    protected $casts = [
        'seo_content' => 'json'
    ];

    public function getImageSrcAttribute()
    {
        return asset('images/uploads/brands/'.$this->image);
    }

    function getSeo(string $key): ?string
    {
        return $this->seo_content[$key] ?? null;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function productSorts(): HasMany
    {
        return $this->hasMany(ProductSort::class, 'model_id')
            ->where('model_type', self::class)
            ->orderBy('pos');
    }


}
