<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'phone',
        'email',
        'city',
        'region',
        'address',
        'is_default',
    ];


    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getFullAddressAttribute()
    {
        return $this->region . ', ' . $this->city . ', ' . $this->address;
    }

}
