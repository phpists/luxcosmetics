<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqGroup extends Model
{
    use HasFactory;

    protected $fillable = ['is_active', 'name', 'position'];

    public $timestamps = false;

    public function faqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Faq::class, 'group_id')
            ->orderBy('position');
    }

    public function activeFaqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->faqs()
            ->where('is_active', 1);
    }

}
