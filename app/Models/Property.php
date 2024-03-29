<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Property extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'properties';

    protected $fillable = ['name', 'measure', 'show_in_filter', 'show_in_product', 'show_text'];

    const HORIZONTAL = 2;
    const VERTICAL = 1;


    protected static function booted (): void
    {

        self::deleted(function (self $model) {
            PropertyCategory::whereIn('property_id', $model->id)->delete();
        });

    }

    public function category_idx(): array
    {
        return PropertyCategory::query()->where('property_id', $this->id)->pluck('category_id')->toArray();
    }

    public function propertyCategories(): HasMany
    {
        return $this->hasMany(PropertyCategory::class, 'property_id');
    }

    public function values()
    {
        return $this->hasMany(PropertyValue::class)
            ->orderBy("value");
    }

}
