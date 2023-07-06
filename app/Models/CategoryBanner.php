<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBanner extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['category_id', 'banner_id', 'pos'];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
