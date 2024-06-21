<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    const TYPE_NETWORK = 1;
    const TYPE_MESSENGER = 2;
    const TYPE_NUMBER = 3;

    const ALL_TYPES = [
        self::TYPE_NETWORK => 'Соціальна мережа',
        self::TYPE_MESSENGER => 'Месенджер',
        self::TYPE_NUMBER => 'Мобільний'
    ];


    protected $fillable = ['id', 'phone', 'type_id', 'pos', 'icon', 'link', 'is_active_in_contacts', 'is_active_in_footer', 'is_active_in_header'];

    public static function boot() {
        parent::boot();

        self::deleting(function($model) {
            $model->dropIcon();
        });
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('positionSorted', function (Builder $builder) {
            $builder->orderBy('pos');
        });
    }

    public function scopeId(Builder $query): void
    {
        $query->where('id', self::TYPE_NETWORK);
    }


    public function scopeNetwork(Builder $query): void
    {
        $query->where('type_id', self::TYPE_NETWORK);
    }

    public function scopeMessenger(Builder $query): void
    {
        $query->where('type_id', self::TYPE_MESSENGER);
    }

    public function scopePhone(Builder $query): void
    {
        $query->where('type_id', self::TYPE_NUMBER);
    }

    public function scopeActiveInContacts(Builder $query): void
    {
        $query->where('is_active_in_contacts', true);
    }

    public function scopeActiveInFooter(Builder $query): void
    {
        $query->where('is_active_in_footer', true);
    }

    public function scopeActiveInHeader(Builder $query): void
    {
        $query->where('is_active_in_header', true);
    }

    public function getIconSrcAttribute()
    {
        return asset('images/uploads/social/' . $this->icon);
    }

    public function dropIcon()
    {
        Storage::disk('public')->delete('/uploads/social/'.$this->icon);
    }

}
