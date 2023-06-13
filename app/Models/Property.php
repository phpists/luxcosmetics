<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Property extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'properties';

    protected $fillable = ['name', 'measure', 'show_in_filter', 'show_in_catalog'];

    public function category_idx(): array
    {
        return PropertyCategory::query()->where('property_id', $this->id)->pluck('category_id')->toArray();
    }

    public function propertyCategories(): HasMany
    {
        return $this->hasMany(PropertyCategory::class, 'property_id');
    }
}
