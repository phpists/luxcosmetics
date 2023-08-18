<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum', 'color',
        'receiver', 'receiver_email',
        'from_whom', 'description',
        'code',
        'activated_by',
        'activated_at',
        'buyer_id',
        'card_id',
        'deactivated_at',
        'balance'
    ];

    protected $casts = [
        'activated_at' => 'datetime'
    ];


    protected static function booted (): void
    {

        self::creating(function(GiftCard $model) {
            $model->balance = $model->sum;
        });

    }


    public function scopeActive($query)
    {
        return $query->whereNull('deactivated_at')
            ->where('balance', '>', 0);
    }

    public function activator()
    {
        return $this->belongsTo(User::class, 'activated_by');
    }


    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }


    public function isActivated()
    {
        return $this->activated_by !== null && $this->activated_at !== null;
    }

    public function isAvailable()
    {
        return $this->deactivated_at == null;
    }

}
