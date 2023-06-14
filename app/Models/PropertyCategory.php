<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    use HasFactory;

    protected $table = 'property_category';

    protected $fillable = ['property_id', 'category_id', 'position'];

    public $timestamps = false;

    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }

    protected function name(): Attribute {
        return Attribute::make(
            get: fn () => $this->property->name
        );
    }
}
