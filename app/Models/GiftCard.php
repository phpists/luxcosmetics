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
        'activated_at'
    ];

    protected $casts = [
        'activated_at' => 'datetime'
    ];



    public function activator()
    {
        return $this->hasOne(User::class, 'id', 'activated_by');
    }



    public function isActivated()
    {
        return $this->activated_by !== null && $this->activated_at !== null;
    }


}
