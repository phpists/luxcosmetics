<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'table_name', 'record_id', 'image', 'description', 'link', 'position', 'is_active', 'description'];

    protected $appends = ['image_src'];

    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function getImageSrcAttribute()
    {
        return asset('images/uploads/articles/'.$this->image);
    }
}
