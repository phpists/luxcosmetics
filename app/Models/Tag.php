<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'link', 'image_path', 'category_id', 'add_to_top', 'position'];
    public function getImageSrcAttribute()
    {
        return asset('images/uploads/tags/'.$this->image_path);
    }
}
