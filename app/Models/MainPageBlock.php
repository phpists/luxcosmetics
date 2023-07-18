<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPageBlock extends Model
{
    use HasFactory;

    protected $table = 'main_page_block';

    protected $fillable = ['title', 'content', 'video_path', 'image_path'];

    public $timestamps = false;

    public function getImageSrcAttribute()
    {
        return asset('images/uploads/main_block/'.$this->image_path);
    }
}
