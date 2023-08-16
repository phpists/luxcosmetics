<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
      'rating','product_id',
      'description',
      'name','email'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
