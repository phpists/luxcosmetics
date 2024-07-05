<?php

namespace App\Models;

use App\Enums\SeoTemplateEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class SeoTemplate extends Model
{

    protected $fillable = [
        'type',
        'hint',
        'title',
        'description'
    ];


    public function getReadyTitle(mixed $model)
    {
        $replaces = SeoTemplateEnum::from($this->type)->getReplaces($model);
        return Str::replace(array_keys($replaces), array_values($replaces), $this->title);
    }

    public function getReadyDescription(mixed $model)
    {
        $replaces = SeoTemplateEnum::from($this->type)->getReplaces($model);
        return Str::replace(array_keys($replaces), array_values($replaces), $this->description);
    }

}
