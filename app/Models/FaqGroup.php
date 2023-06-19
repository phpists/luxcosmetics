<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqGroup extends Model
{
    use HasFactory;

    protected $fillable = ['is_active', 'name', 'position'];

    public $timestamps = false;
}
