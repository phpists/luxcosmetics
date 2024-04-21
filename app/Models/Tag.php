<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'link', 'image_path', 'add_to_top', 'position', 'morphable_id', 'morphable_type'];
    public function getImageSrcAttribute()
    {
        return asset('images/uploads/tags/'.$this->image_path);
    }

    function morphable()
    {
        return $this->morphTo();
    }

}
