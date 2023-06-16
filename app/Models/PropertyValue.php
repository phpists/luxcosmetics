<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    use HasFactory;

    protected $table = 'property_value';

    public $timestamps = false;

    protected $fillable = ['property_id', 'value'];

}
