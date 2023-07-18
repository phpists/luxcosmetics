<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    /**
     * Types
     */
    const PRODUCTS = 'products';

    protected $table = 'seo';

    protected $fillable = [
        'table_name',
        'record_id',
        'title',
        'description',
        'keywords'
    ];
}
