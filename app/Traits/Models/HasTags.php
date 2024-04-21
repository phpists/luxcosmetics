<?php

namespace App\Traits\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTags
{

    function tags(): MorphMany
    {
        return $this->morphMany(Tag::class, 'morphable')
            ->orderBy('position');
    }

    function topTags(): MorphMany
    {
        return $this->tags()
            ->whereAddToTop(true);
    }

    function bottomTags(): MorphMany
    {
        return $this->tags()
            ->whereAddToTop(false);
    }

}
