<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'title'
    ];

    public function isDeletable()
    {
        return $this->is_system == 0;
    }

}
