<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Role
     */
    const SUPER_ADMIN = 1;
    const USER = 2;
    const ADMIN = 3;

    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'phone',
        'birthday',
        'is_subscribed',
        'connection_type',
        'points',
        'is_active',
        'gift_card_balance',
        'role_id'
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
        'birthday' => 'date'
    ];


    public function scopeCustomers($query)
    {
        return $query->where('role_id', self::USER);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role_id', self::ADMIN);
    }




    public function cards(): HasMany
    {
        return $this->hasMany(PaymentCard::class);
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Address::class)
            ->where('is_default', 1);
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

    public function getStatus(): string
    {
        return $this->is_active ? 'Активен': 'Заблокирован';
    }


    public function hasGiftCardBalance()
    {
        return $this->activeGiftCard != null;
    }


    public function giftCards()
    {
        return $this->hasMany(GiftCard::class, 'activated_by');
    }

    public function activeGiftCard()
    {
        return $this->hasOne(GiftCard::class, 'activated_by')
            ->latest()
            ->active();
    }

    public function lastGiftCard()
    {
        return $this->hasOne(GiftCard::class, 'activated_by')
            ->limit(1)
            ->orderBy('id', 'DESC');
    }

    public function comments()
    {
        return $this->hasMany(CommentsAction::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function isAdmin()
    {
        return in_array($this->role_id, [User::ADMIN, User::SUPER_ADMIN]);
    }

    public function isSuperAdmin()
    {
        return $this->role_id === self::SUPER_ADMIN;
    }

    public function routeNotificationForSms(?Notification $notification = null)
    {
        return $this->phone;
    }
}
