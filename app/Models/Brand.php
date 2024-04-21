<?php

namespace App\Models;

use App\Traits\Models\HasTags;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasTags;

    protected $fillable = ['name', 'image', 'link', 'hide', 'seo_content'];

    public $timestamps = false;

    protected $casts = [
        'seo_content' => 'json'
    ];

    public function getImageSrcAttribute()
    {
        return asset('images/uploads/brands/'.$this->image);
    }

    function getSeo(string $key): string
    {
        return $this->seo_content[$key] ?? '';
    }

}
