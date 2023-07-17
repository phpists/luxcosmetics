<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionCategory extends Model
{
    use HasFactory;

    protected $table = 'subscription_categories';

    protected $fillable = ['name'];

    public $timestamps = false;
}
