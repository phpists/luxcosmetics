<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\PromoCode;
use Exception;
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
    const PROMO_KEY = 'cart_promo';


    const ALL_KEYS = [
        self::DELIVERY_KEY => 'Способ доставки',
        self::ADDRESS_KEY => 'Адрес',
        self::GIFT_BOX_KEY => 'Подарочная коробка',
        self::AS_DELIVERY_ADDRESS_KEY => 'Использовать как адрес доставки',
        self::CARD_KEY => 'Карта для оплаты'
    ];

    public $discounts = [];



    private function initializeDiscounts()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->checkDiscount();

            if ($user->hasGiftCardBalance()) {
                $this->discounts['gift_card_balance'] = [
                    'title' => 'Баланс подарочной карты',
                    'amount' => $this->getUsedGiftCardDiscount()
                ];
            }

            if ($this->isUsedPromo()) {
                $this->discounts['promo_code'] = [
                    'title' => "Промокод {$this->getPromoCode()}",
                    'amount' => $this->getUsedPromoDiscount()
                ];
            }

            if ($this->isUsedBonuses()) {
                $this->discounts['bonuses'] = [
                    'title' => 'Бонусные баллы',
                    'amount' => $this->getUsedBonusesDiscount()
                ];
            }
        }
    }

    public function getAllItems()
    {
        return session()->get(self::SESSION_KEY, []);
    }

    public function getAllProducts(array $category_ids = [])
    {
        $cart = session()->get(self::SESSION_KEY, []);
        $product_ids = self::getAllProductIds();

        $query = Product::whereIn('products.id', $product_ids)
            ->with('categories');

        if (!empty($category_ids))
            $query->whereIn('products.category_id', $category_ids)
                ->orWhereHas('categories', function ($query) use($category_ids) {
                    $query->whereIn('product_categories.category_id', $category_ids);
                });

        $products = $query->get();

        $products->map(function ($item) use ($cart) {
            $item->quantity = $cart[$item->id]['quantity'] ?? 1;
            $item->total_sum = $item->quantity * $item->price;
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
        $this->initializeDiscounts();

        if (isset($this->discounts['gift_card_balance']))
            $totalSum = $totalSum - $this->discounts['gift_card_balance']['amount'];

        if (isset($this->discounts['promo_code']))
            $totalSum = $totalSum - $this->discounts['promo_code']['amount'];

        if (isset($this->discounts['bonuses']))
            $totalSum = $totalSum - $this->discounts['bonuses']['amount'];


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
        if ($this->isUsedGiftCardDiscount()) {
            $order_data['gift_card_discount'] = $this->getUsedGiftCardDiscount();
            $order_data['gift_card_id'] = \auth()->user()->activeGiftCard->id;
        }
        if ($this->isUsedBonuses()) {
            $order_data['bonuses_discount'] = $this->getUsedBonusesDiscount();
            $order_data['is_used_bonuses'] = 1;
        }
        if ($this->isUsedPromo()) {
            $order_data['promo_code_discount'] = $this->getUsedPromoDiscount();
            $order_data['promo_code_id'] = $this->getPromo()->id;
        }

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
                $user->activeGiftCard->decrement('balance', $this->getTotalSum() - $order->total_sum);

            if ($this->isUsedBonuses())
                $user->decrement('points', $this->getUsedBonusesDiscount());

            if ($this->isUsedPromo())
                $this->getPromo()->increment('uses');

//            $user->update([ // TODO: перенести це на етап, коли замовлення буде позначено як "ЗАВЕРШЕНЕ"
//                'points' => $this->getBonusAmount()
//            ]);

            session()->forget(self::SESSION_KEY);
            session()->forget(array_keys(self::ALL_KEYS));
            $this->dropBonuses();
            $this->dropPromo();

            return $order->id;
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return null;
        }
    }



    public function isUsedGiftCardDiscount(): bool
    {
        if (\auth()->check())
            return \auth()->user()->hasGiftCardBalance();

        return false;
    }

    public function getUsedGiftCardDiscount(): int
    {
        if (Auth::check()) {
            $user = Auth::user();
            $maxDiscount = min($this->getTotalSum(), $user->activeGiftCard->balance);
            return $maxDiscount;
        }
        return 0;
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

    /**
     * @throws Exception
     */
    public function verifyBonusesConditions($amount): bool
    {
        if (!\auth()->check())
            throw new Exception('Бонусы можно использовать только авторизованным пользователям');

        $user = \auth()->user();

//        if ($user->hasGiftCardBalance())
//            throw new Exception('На этот заказ уже действует подарочная карта');
//
//        if ($this->isUsedPromo())
//            throw new Exception('На этот заказ уже действует промокод');

        if ($user->points < $amount)
            throw new Exception('У вас на балансе нету столько баллов!');

        $total_cart_sum = $this->getTotalSum();
        $half = round($total_cart_sum - ($total_cart_sum / 2), 2);
        if ($half < $amount)
            throw new Exception('Не больше 50% от суммы заказа - ' . $half);

        return true;
    }

    public function checkBonuses(): void
    {
        try {
            $this->verifyBonusesConditions($this->getUsedBonusesDiscount());
        } catch (Exception $exception) {
            session()->flash('error', 'Бонусы больше не соответствуют требованиям: ' . $exception->getMessage());
            $this->dropBonuses();
        }
    }




    public function usePromo(string $code): void
    {
        session()->put(self::PROMO_KEY, $code);
    }

    public function isUsedPromo(): bool
    {
        return session()->has(self::PROMO_KEY);
    }

    public function getPromoCode()
    {
        return session()->get(self::PROMO_KEY);
    }

    public function getPromo(): ?PromoCode
    {
        return PromoCode::where('code', $this->getPromoCode())->first();
    }

    public function getUsedPromoDiscount()
    {
        $promoCode = $this->getPromo();
        $amount = 0;

        if ($promoCode->amount) {
            $amount = $promoCode->amount;
        } elseif ($promoCode->percent) {
            $totalSum = $this->getTotalSumWithDiscounts();

            if ($promoCode->type == PromoCode::TYPE_CART) {
                $amount = $totalSum * ($promoCode->percent / 100);
            } elseif ($promoCode->type == PromoCode::TYPE_CATEGORY) {
                $category_ids = Category::getChildIds($promoCode->category_id);
                $products = $this->getAllProducts($category_ids);
                $temp_sum = $products->sum('total_sum');
                $amount = $temp_sum * ($promoCode->percent / 100);
            } elseif ($promoCode->type == PromoCode::TYPE_PRODUCT) {
                $product = $this->getAllProducts()->where('id', $promoCode->product_id)->first();
                $amount = $product->total_sum * ($promoCode->percent / 100);
            }
        }

        return $amount;
    }

    public function dropPromo(): void
    {
        session()->forget(self::PROMO_KEY);
    }

    /**
     * @throws Exception
     */
    public function verifyPromoConditions(PromoCode $promoCode): bool
    {
        if (!\auth()->check())
            throw new Exception('Промокоды можно использовать только авторизованным пользователям');

//        if (\auth()->user()->hasGiftCardBalance())
//            throw new Exception('На этот заказ уже действует подарочная карта');
//
//        if ($this->isUsedBonuses())
//            throw new Exception('На этот заказ уже действует скидка от бонусов');

        if ($promoCode->type == PromoCode::TYPE_CART) {
            if ($promoCode->min_sum && $promoCode->min_sum > $this->getTotalSum())
                throw new Exception("Сумма в корзине должна быть не меньше {$promoCode->min_sum} для использования этого промокода");
        } elseif ($promoCode->type == PromoCode::TYPE_PRODUCT) {
            if(!$this->getAllProducts()->contains('id', $promoCode->product_id))
                throw new Exception("Прмокод действует только на товар '{$promoCode->product->title}'");
        } elseif ($promoCode->type == PromoCode::TYPE_CATEGORY) {
            $category_ids = Category::getChildIds($promoCode->category_id);
            if (!$this->checkCategoryInCart($category_ids))
                throw new Exception("Прмокод действует только на категорию '{$promoCode->category->name}' и сопутствующие категории");
        }

        return true;
    }

    public function checkPromo(): void
    {
        try {
            $this->verifyPromoConditions($this->getPromo());
        } catch (Exception $exception) {
            session()->flash('error', 'Промокод больше не соответствует требованиям: ' . $exception->getMessage());
            $this->dropPromo();
        }
    }

    public function checkCategoryInCart(array $category_ids): bool
    {
        $products = $this->getAllProducts();
        foreach ($products as $product) {
            $product_categories = $product->categories()->pluck('categories.id')->toArray();
            $product_categories[] = $product->category_id;
            foreach ($product_categories as $product_category_id) {
                if (in_array($product_category_id, $category_ids))
                    return true;
            }
        }

        return false;
    }



    public function checkDiscount(): void
    {
        if ($this->isUsedPromo())
            $this->checkPromo();

        if ($this->isUsedBonuses())
            $this->checkBonuses();
    }


}
