<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeMainSlider extends Model
{
    use HasFactory;

    protected $table = 'home_main_slider';
    protected $fillable = [
        'file',
        'title',
        'description',
        'btn_title',
        'link',
        'status',
        'pos',
    ];

    public function getImage()
    {
        return asset('images/uploads/home_main_slider/' . $this->file);
    }
}

