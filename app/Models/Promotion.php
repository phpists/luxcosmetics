<?php

namespace App\Models;

use App\Traits\Models\HasSeoData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Promotion extends Model
{
    use HasSlug,
        HasSeoData;

    const IMAGES_PATH = 'promotions';

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'starts_at',
        'ends_at',
        'bg_img',
        'btn_title',
        'btn_link',
        'preview_img',
        'is_active',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
        'is_active' => 'bool',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive(Builder $query)
    {
        $query->where('is_active', true);
    }

    protected function previewImgSrc(): Attribute
    {
        return Attribute::get(fn() => asset("images/uploads/" . $this::IMAGES_PATH . '/' . $this->preview_img));
    }

    protected function bgImgSrc(): Attribute
    {
        return Attribute::get(fn() => asset("images/uploads/" . $this::IMAGES_PATH . '/' . $this->bg_img));
    }

    public function properties(): HasMany
    {
        return $this->hasMany(PromotionProperty::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promotion_products')
            ->withPivot('pos')
            ->orderByPivot('pos');
    }

    protected function periodTitle(): Attribute
    {
        return Attribute::get(function() {
            if (Carbon::now()->lte($this->ends_at)) {
                $startsTitle = Carbon::parse($this->starts_at)->locale('ru')->isoFormat('D MMMM');
                $endsTitle = Carbon::parse($this->ends_at)->locale('ru')->isoFormat('D MMMM');

                return 'с ' . $startsTitle . ' по ' . $endsTitle;
            } else {
                return 'Закончилась';
            }
        });
    }
}
