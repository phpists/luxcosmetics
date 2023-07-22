<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Role
     */
    const ADMIN = 1;
    const USER = 2;

    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'phone',
        'birthday',
        'is_subscribed',
        'connection_type',
        'points'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(PaymentCard::class);
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function firstAddress(): Attribute
    {
        return Attribute::make(
            get: fn() => Address::query()->where('user_id', $this->id)->where('is_default', '1')->first()
        );
    }

    protected function defaultCard(): Attribute
    {
        return Attribute::make(
            get: fn() => PaymentCard::query()->where('user_id', $this->id)->where('is_default', '1')->first()
        );
    }

    public function chats(): Attribute
    {
        return Attribute::make(
            get: fn() => FeedbackChat::query()
                ->select('feedback_chats.*')
                ->join('feedback_message', 'feedback_chats.id', 'feedback_message.chat_id')
                ->where('feedback_message.user_id', $this->id)
                ->get()
        );
    }

    static public function getConnectionOptions(): array
    {
        return array_column(\App\Enums\ConnectionOptions::cases(), 'value');
    }

    /**
     * Отримати вік
     */
    public function getAge()
    {
        $age = '';
        if ($this->birthday) {
            $age = Carbon::parse($this->birthday)->diffInYears(Carbon::now());
        }

        return "({$age} года/лет)";
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
