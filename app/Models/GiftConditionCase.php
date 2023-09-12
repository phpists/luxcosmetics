<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftConditionCase extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['gift_condition_id', 'foreign_id'];

}
