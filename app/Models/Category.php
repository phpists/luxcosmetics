<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use App\Traits\Models\HasCatalogBanners;
use App\Traits\Models\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasTags, HasCatalogBanners;

    protected $table = "categories";

    protected $fillable = [
        "name",
        "alias",
        "key",
        "category_id",
        "position",
        "status",
        "add_to_top_menu",
        "image",
        "description_meta",
        "keywords_meta",
        "bottom_title",
        "bottom_text",
        "breadcrumb",
        "hidden_bottom_text",
        'h1'
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function parent()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class)->with("categories");
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function productsAsAdditional()
    {
        return $this->belongsToMany(Product::class, ProductCategory::class);
    }

    public function properties()
    {
        return $this->belongsToMany(
            Property::class,
            "property_category",
            "category_id",
            "property_id"
        )->orderBy("property_category.position");
    }

    public function filter_properties()
    {
        return $this->properties()
            ->whereHas("values")
            ->where("show_in_filter", 1);
    }

    public function banners()
    {
        return $this->belongsToMany(Banner::class, "category_banners")->orderBy(
            "pos"
        );
    }

    public function articles()
    {
        return $this->hasMany(Article::class, "record_id")
            ->where("table_name", "categories")
            ->orderBy("position");
    }

    public function productSorts(): HasMany
    {
        return $this->hasMany(ProductSort::class, 'model_id')
            ->where('model_type', self::class)
            ->orderBy('pos');
    }

    public static function getChildIds(string|int|array $category_id): array
    {
        if (is_array($category_id)) {
            $result = [];
            foreach ($category_id as $item)
                $result = array_merge(self::getChildIds($item), $result);

            return $result;
        }

        return Cache::rememberForever('category_child_ids_' . $category_id, function () use ($category_id) {
            $ids = [$category_id];
            $category = self::find($category_id);

            if ($category->subcategories) {
                foreach ($category->subcategories as $subcategory) {
                    $ids = array_merge($ids, self::getChildIds($subcategory->id));
                }
            }

            return $ids;
        });
    }

    public function posts(): HasMany
    {
        return $this->hasMany(CategoryPost::class);
    }
}
