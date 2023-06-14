<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    const TOP_MENU = 1;
    const FOOTER_MENU = 2;

    protected $fillable = [
        'type',
        'parent_id',
        'title',
        'link',
        'position',
        'is_active'
    ];

    public $timestamps = false;

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function subchildren() {
        return $this->hasMany(Menu::class, 'parent_id')->with('children');
    }

    public function getChildren($items) {
        return $items->where('parent_id', $this->id);
    }
}
