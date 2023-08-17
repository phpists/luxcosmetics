<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartService
{

    const SESSION_KEY = 'cart';
    const DELIVERY_KEY = 'delivery_type';
    const ADDRESS_KEY = 'address_id';
    const GIFT_BOX_KEY = 'gift_box';
    const AS_DELIVERY_ADDRESS_KEY = 'as_delivery_address';
    const CARD_KEY = 'card_id';


    const BONUSES_KEY = 'cart_bonuses';


    const ALL_KEYS = [
        self::DELIVERY_KEY => 'Способ доставки',
        self::ADDRESS_KEY => 'Адрес',
        self::GIFT_BOX_KEY => 'Подарочная коробка',
        self::AS_DELIVERY_ADDRESS_KEY => 'Использовать как адрес доставки',
        self::CARD_KEY => 'Карта для оплаты'
    ];

    public $discount_reasons = [];


    public function getAllItems()
    {
        return session()->get(self::SESSION_KEY, []);
    }

    public function getAllProducts()
    {
        $cart = session()->get(self::SESSION_KEY, []);
        $product_ids = self::getAllProductIds();

        $products = Product::whereIn('products.id', $product_ids)
            ->get();

        $products->map(function ($item) use ($cart) {
            $item->quantity = $cart[$item->id]['quantity'] ?? 1;
        });

        return $products;
    }

    public function getAllProductIds()
    {
        $product_id = array_map(function ($item) {
            return $item['product_id'];
        }, self::getAllItems());

        return $product_id;
    }

    public function getProduct($product_id)
    {
        return Product::findOrFail($product_id);
    }

    public function getTotalSum()
    {
        $cart = session()->get(self::SESSION_KEY, []);

        $products = $this->getAllProducts();
        $products->map(function ($item) use ($cart) {
            $item->total_sum = ($cart[$item->id]['quantity'] ?? 1) * $item->price;
        });
        $totalSum = $products->sum('total_sum');

        return round($totalSum, 2) ?? 0;
    }

    public function getTotalSumWithDiscounts()
    {
        $totalSum = $this->getTotalSum();

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasGiftCardBalance()) {
                $maxDiscount = min($totalSum, $user->gift_card_balance);
                $totalSum = $totalSum - $maxDiscount;
                $this->discount_reasons[] = [
                    'title' => 'Баланс подарочной карты',
                    'name' => 'gift_card_balance',
                    'amount' => $maxDiscount
                ];
            }

            if ($this->isUsedBonuses()) {
                $totalSum = $totalSum - $this->getUsedBonusesDiscount();
                $this->discount_reasons[] = [
                    'title' => 'Бонусные баллы',
                    'name' => 'bonuses',
                    'amount' => $this->getUsedBonusesDiscount()
                ];
            }
        }

        return round($totalSum, 2) ?? 0;
    }

    public function getBonusAmount()
    {
        $bonus_points = 0;

        foreach (self::getAllItems() as $item) {
            $product = self::getProduct($item['product_id']);
            $bonus_points += ($item['quantity'] * $product->points);
        }

//        $user = Auth::user();
//        return ($user->points + $bonus_points);
        return $bonus_points;
    }

    public function getTotalCount(): int
    {
        return count(self::getAllItems());
    }

    public function isNotEmpty(): bool
    {
        return self::getTotalCount() > 0;
    }

    public function add($product_id, $quantity = 1)
    {
        $cart = session()->get(self::SESSION_KEY, []);
        if (!isset($cart[$product_id]) && $this->canAdd($product_id)) {
            $cart[$product_id] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
            ];
            session([self::SESSION_KEY => $cart]);
        }
    }

    public function remove($product_id)
    {
        if ($product_id) {
            $cart = session()->get(self::SESSION_KEY, []);
            if (isset($cart[$product_id]))
                unset($cart[$product_id]);

            session([self::SESSION_KEY => $cart]);
        }
    }

    public function check($product_id)
    {
        $cart = session()->get(self::SESSION_KEY, []);
        return isset($cart[$product_id]);
    }

    public function plusQuantity($product_id): int
    {
        $cart = session()->get(self::SESSION_KEY, []);
        $quantity = 0;

        if (isset($cart[$product_id])) {
            $quantity = ++$cart[$product_id]['quantity'];
            session([self::SESSION_KEY => $cart]);
        }

        return $quantity;
    }

    public function minusQuantity($product_id): int
    {
        $cart = session()->get(self::SESSION_KEY, []);
        $quantity = 1;

        if (isset($cart[$product_id])) {
            if ($cart[$product_id]['quantity'] > 1) {
                $quantity = --$cart[$product_id]['quantity'];
            }
            session([self::SESSION_KEY => $cart]);
        }

        return $quantity;
    }


    /**
     * Перевіряє чи можна додати товар в корзину
     *
     * @param $product_id
     * @return bool
     */
    public function canAdd($product_id): bool
    {
        $product = Product::find($product_id);

        return $product->status == 1;
    }

    public function clear()
    {
        session([self::SESSION_KEY => []]);
    }


    public function setProperty($name, $value)
    {
        session([$name => $value]);
    }

    public function getProperty($name)
    {
        return session()->get($name) ?? null;
    }

    public static function canCheckout(): bool
    {
        $min_sum = SiteConfigService::getParamValue('min_checkout_sum');
        if ($min_sum)
            return (new self())->getTotalSum() >= $min_sum;

        return true;
    }



    public function store(): ?int
    {
        if (!self::isNotEmpty())
            return null;

        $order_data = Arr::mapWithKeys(self::ALL_KEYS, function ($title, $name) {
            return [$name => $this->getProperty($name)];
        });
        $order_data['user_id'] = Auth::id();
        $order_data['total_sum'] = self::getTotalSumWithDiscounts();
        $address_id = $order_data['address_id'];
        unset($order_data['address_id']);
        $address = Address::find($address_id);
        $order_data['full_name'] = $address['name'] . ' ' . $address['surname'];
        $order_data['phone'] = $address['phone'];
        $order_data['city'] = $address['city'];
        $order_data['region'] = $address['region'];
        $order_data['address'] = $address['address'];

        try {
            $order = Order::create($order_data);

            foreach (self::getAllItems() as $item) {
                $product = self::getProduct($item['product_id']);
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'old_price' => $product->old_price
                ]);
            }
            $user = Auth::user();

            if ($this->isUsedGiftCardDiscount())
                $user->decrement('gift_card_balance', $this->getTotalSum() - $order->total_sum);

            if ($this->isUsedBonuses())
                $user->decrement('points', $this->getUsedBonusesDiscount());

//            $user->update([ // TODO: перенести це на етап, коли замовлення буде позначено як "ЗАВЕРШЕНЕ"
//                'points' => $this->getBonusAmount()
//            ]);

            session()->forget(self::SESSION_KEY);
            session()->forget(array_keys(self::ALL_KEYS));
            session()->forget(self::BONUSES_KEY);

            return $order->id;
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return null;
        }
    }



    public function isUsedDiscount($name): bool
    {
        $discounts_collection = new Collection($this->discount_reasons);
        $discount_reasons = $discounts_collection->map(function ($item) {
            return $item['name'];
        });

        return $discount_reasons->contains($name);
    }

    public function isUsedGiftCardDiscount(): bool
    {
        return $this->isUsedDiscount('gift_card_balance');
    }

    public function isUsedBonuses(): bool
    {
        return session()->has(self::BONUSES_KEY);
    }

    public function getUsedBonusesDiscount()
    {
        return session()->get(self::BONUSES_KEY, 0);
    }

    public function useBonuses(float $amount): void
    {
        session()->put(self::BONUSES_KEY, $amount);
    }

    public function dropBonuses(): void
    {
        session()->forget(self::BONUSES_KEY);
    }


}
