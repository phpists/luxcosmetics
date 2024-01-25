<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos',
        'is_active',
        'title',
        'name'
    ];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }


    public static function getAll()
    {
        return self::active()->orderBy('pos')->get();
    }

}
