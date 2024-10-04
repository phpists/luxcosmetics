<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodeCase extends Model
{

    protected $fillable = [
        'promo_code_id',
        'model_id',
        'model_type',
    ];

    public function model()
    {
        return $this->morphTo();
    }

}
