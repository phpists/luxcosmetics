<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    use HasFactory;

    protected $table = 'best_seller';
    protected $fillable = [
        'title',
        'description',
        'link',
        'image',
    ];

    public function getImage()
    {
        return asset('images/uploads/best_sellers/' . $this->image);
    }
}
