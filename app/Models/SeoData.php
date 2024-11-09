<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoData extends Model
{
    protected $fillable = [
        'seoable_id',
        'seoable_type',
        'data',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function getMeta(string $key): ?string
    {
        return $this->data['meta'][$key] ?? null;
    }

    public function getOG(string $key): ?string
    {
        return $this->data['og'][$key] ?? $this->getMeta($key);
    }
}
