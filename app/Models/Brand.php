<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'link'];

    public $timestamps = false;

    public function getImageSrcAttribute()
    {
        return asset('images/uploads/brands/'.$this->image);
    }
}
