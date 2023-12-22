<?php

namespace App\Models;

use App\Events\OrderCancelled;
use App\Mail\Admin\OrderCreated;
use App\Mail\OrderStatusChangedMail;
use App\Services\OrderPaymentService;
use App\Services\SiteConfigService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    use HasFactory;

    const DELIVERY_TYPE_STANDARD = 'standard';
    const DELIVERY_TYPE_EXPRESS = 'express';

    const ALL_DELIVERY_TYPES = [
        self::DELIVERY_TYPE_STANDARD => 'Стандартная',
        self::DELIVERY_TYPE_EXPRESS => 'Экспресс'
    ];


    const DELIVERY_COURIER = 'courier';
    const DELIVERY_SELF_PICKUP = 'pickup';

    const ALL_DELIVERIES = [
        self::DELIVERY_COURIER => 'Курьер',
        self::DELIVERY_SELF_PICKUP => 'Самовынос'
    ];

    const DELIVERY_SERVICE_CDEK = 'cdek';
    const DELIVERY_SERVICE_BOXBERRY = 'boxberry';

    const ALL_DELIVERY_SERVICES = [
        self::DELIVERY_SERVICE_CDEK => 'СДЭК',
        self::DELIVERY_SERVICE_BOXBERRY => 'Boxberry'
    ];


    const PAYMENT_SBP = 'sbp';
    const PAYMENT_ONLINE = 'online';
    const PAYMENT_PARTS = 'parts';
    const PAYMENT_SBER = 'sber';

    const ALL_PAYMENTS = [
        self::PAYMENT_SBP => 'СБП',
        self::PAYMENT_ONLINE => 'Оплата онлайн',
//        self::PAYMENT_PARTS => 'Оплата Долями',
//        self::PAYMENT_SBER => 'SberPay',
    ];


    const STATUS_NEW = 1;
    const STATUS_PAYED = 2;
    const STATUS_GIVEN_LMS = 3;
    const STATUS_DELIVERED_TO_VPZ = 4;
    const STATUS_COMPLETED = 5;
    const STATUS_CANCELLED = 6;


    protected $fillable = [
        'status_id',
        'user_id',
        'address_id',
        'card_id',
        'total_sum',
        'gift_box',
        'phone',
        'address',
        'gift_card_id',
        'is_used_bonuses',
        'promo_code_id',
        'gift_card_discount',
        'bonuses_discount',
        'promo_code_discount',
        'bonuses_given',
        'first_name',
        'last_name',
        'email',
        'payment_type',
        'delivery_type',
        'invoice_id',
        'is_received_by_1c',
        'note',
        'city',
        'street',
        'house',
        'zip',
        'apartment',
        'intercom',
        'entrance',
        'over',
        'service'
    ];



    protected static function booted (): void
    {

        self::created(function (Order $order) {
            $ordersInCurrentMonthCount = Order::whereYear('created_at', '=', now()->format('Y'))->whereMonth('created_at', '=', now()->format('m'))->count();

            do {
                $num = "ИМ-" . date('ym') . '/' . str_pad($ordersInCurrentMonthCount, 4, 0, STR_PAD_LEFT);
                $ordersInCurrentMonthCount++;
            } while (Order::whereNum($num)->exists());

            $order->num = $num;
            $order->save();

            $admin_email = SiteConfigService::getParamValue(SiteConfigService::EMAIL_FOR_ORDERS);
            if ($admin_email) {
                Mail::to($admin_email)->send(new OrderCreated($order));
            }
        });

        self::updated(function(Order $order) {
            if ($order->isDirty('status_id')) {
                Mail::to($order->user->email)->send(new OrderStatusChangedMail($order));

                if ($order->status_id == self::STATUS_CANCELLED)
                    event(new OrderCancelled($order));
            }
        });

        self::deleted(function (Order $order) {
            $order->orderProducts()->delete();
            $order->orderGiftProducts()->delete();
        });

    }


    public function scopeNew($query)
    {
        return $query->where('status_id', self::STATUS_NEW);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status_id', self::STATUS_COMPLETED);
    }

    public function scopeCurrentMonth($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfMonth());
    }

    public function scopeToday($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfDay());
    }

    public function scopeNewFor1C($query)
    {
        return $query->where('is_received_by_1c', 0);
    }


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }


    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderProduct::class,
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function card()
    {
        return $this->belongsTo(PaymentCard::class);
    }

    public function giftCard()
    {
        return $this->belongsTo(GiftCard::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderGiftProducts()
    {
        return $this->hasMany(OrderGiftProduct::class);
    }

    public function giftProducts()
    {
        return $this->hasManyThrough(
            GiftProduct::class,
            OrderGiftProduct::class,
            'order_id',
            'id',
            'id',
            'gift_product_id'
        );
    }


    public function isUsedBonuses()
    {
        return $this->is_used_bonuses == 1;
    }



    public function getPrettyCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function isCompleted()
    {
        return $this->status_id == self::STATUS_COMPLETED;
    }

    public function getTotalDiscount()
    {
        return $this->gift_card_discount + $this->bonuses_discount + $this->promo_code_discount;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }



    public function getPaymentUrl()
    {
        if ($this->invoice_id) {
            $server_url = config('paykeeper.server_url');
            return "{$server_url}/bill/{$this->invoice_id}/";
        } else {
            return (new OrderPaymentService($this))->getPaymentUrl();
        }
    }


    public function canBeCancelled(): bool
    {
        if ($this->created_at->hour > 15 && $this->created_at->hour < 21) {
            if ($this->created_at->isToday() && Carbon::now()->hour < 21)
                return true;
        } else {
            if ($this->created_at->isYesterday() && Carbon::now()->hour > 21
                || $this->created_at->isToday() && Carbon::now()->hour < 15)
                return true;
        }

        return false;
    }


}
