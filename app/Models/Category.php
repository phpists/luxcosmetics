<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'alias', 'key', 'category_id', 'position', 'status', 'add_to_top_menu', 'image'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_category', 'category_id', 'property_id')
            ->whereHas('values')
            ->orderBy('property_category.position');
    }
}
