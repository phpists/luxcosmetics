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

    protected $fillable = ['name', 'alias', 'key', 'category_id', 'position', 'status', 'add_to_top_menu', 'image', 'description_meta', 'keywords_meta', 'bottom_title', 'bottom_text', 'breadcrumb'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
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
            ->orderBy('property_category.position');
    }

    public function filter_properties()
    {
        return $this->properties()
            ->whereHas('values')
            ->where('show_in_filter', 1);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function banners()
    {
        return $this->belongsToMany(Banner::class, 'category_banners')
            ->orderBy('pos');
    }

    public function articles() {
        return $this->hasMany(Article::class, 'record_id')
            ->where('table_name', 'categories')
            ->orderBy('position');
    }

}
