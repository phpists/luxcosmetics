<?php

namespace App\Services;

use App\Enums\AvailableOptions;
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
use Illuminate\Support\Facades\Log;

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

    public function getTotalSumWithDiscounts($with_promo_code = true, $with_bonuses = true, $with_gift_card = true)
    {
        $total_sum = $this->getTotalSum();

        if (Auth::check()) {
            $user = Auth::user();
            $this->checkDiscount();


            if ($with_promo_code && $this->isUsedPromo()) {
                $discount = $this->getUsedPromoDiscount($total_sum);
                $this->discounts['promo_code'] = [
                    'title' => "Промокод {$this->getPromoCode()}",
                    'amount' => $discount
                ];
                $total_sum -= $discount;
            }

            if ($with_bonuses && $this->isUsedBonuses()) {
                $discount = $this->getUsedBonusesDiscount();
                $this->discounts['bonuses'] = [
                    'title' => 'Бонусные баллы',
                    'amount' => $discount
                ];
                $total_sum -= $discount;
            }

            $discount = $this->getUsedGiftCardDiscount($total_sum);
            if ($with_gift_card && $discount > 0) {
                $this->discounts['gift_card_balance'] = [
                    'title' => 'Баланс подарочной карты',
                    'amount' => $discount
                ];
                $total_sum -= $discount;
            }
        }

        return round($total_sum, 2) ?? 0;
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


    public function containUnavailable()
    {
        return $this->getAllProducts()->contains(function ($item) {
            return $item->availability !== AvailableOptions::AVAILABLE->value;
        });
    }

    public static function canCheckout(): bool
    {
        $cartService = new self();

        if ($cartService->containUnavailable())
            return false;

        $min_sum = SiteConfigService::getParamValue('min_checkout_sum');
        if ($min_sum)
            return $cartService->getTotalSum() >= $min_sum;

        return true;
    }

    public function canNotCheckoutMessage(): ?string
    {
        if ($this->containUnavailable())
            return 'Невозможно оформить заказ, так как в корзине присутствует товар которого больше недоступен';

        return null;
    }

    /**
     * @param int|string $id id
     * @param int $amount_bought Amount of purchased products
     * @return bool
     */
    private function decreaseAmountOfProduct(int|string $id, int $amount_bought): bool
    {
        $product = Product::query()->find($id);
        $product->items_left = $product->items_left - $amount_bought;
        if ($product->items_left < 1) {
            $product->availability = AvailableOptions::NOT_AVAILABLE->value;
        }
        return $product->save();
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
        $order_data['promo_code_discount'] = null;
        $order_data['bonuses_discount'] = null;
        $order_data['gift_card_discount'] = null;

        $promo_code_discount = $this->discounts['promo_code']['amount'] ?? 0;
        if ($promo_code_discount) {
            $order_data['promo_code_discount'] = $promo_code_discount;
            $order_data['promo_code_id'] = $this->getPromo()->id;
        }

        $bonuses_discount = $this->discounts['bonuses']['amount'] ?? 0;
        if ($bonuses_discount) {
            $order_data['bonuses_discount'] = $bonuses_discount;
            $order_data['is_used_bonuses'] = 1;
        }

        $gift_card_discount = $this->discounts['gift_card_balance']['amount'] ?? 0;
        if ($gift_card_discount) {
            $order_data['gift_card_discount'] = $gift_card_discount;
            $order_data['gift_card_id'] = \auth()->user()->activeGiftCard->id;
        }

        $order_data['bonuses_given'] = $this->getBonusAmount(); // вказуємо скільки бонусів користувач отримає

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
                // Decrease count of products in store
                $decrease_result = $this->decreaseAmountOfProduct($item['product_id'], $item['quantity']);
                // If false it means failed to decrease amount of products
                if (!$decrease_result) {
                    Log::error("Couldn't decrease amount of products with id ".$item['product_id'].' order id - '.$order->id);
                }
            }
            $user = Auth::user();

            $order->orderGiftProducts()->createMany($this->getGiftProducts()->map(function ($item) {
                return ['gift_product_id' => $item->id];
            }));

            if ($promo_code_discount)
                $this->getPromo()->increment('uses');

            if ($bonuses_discount)
                $user->decrement('points', $bonuses_discount);

            if ($gift_card_discount)
                $user->activeGiftCard->decrement('balance', $gift_card_discount);

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




    public function getUsedGiftCardDiscount($total_sum = null): int
    {
        if (Auth::check() && \auth()->user()->hasGiftCardBalance()) {
            $user = Auth::user();

            if (is_null($total_sum))
                $total_sum = $this->getTotalSum();


            if ($total_sum > 0) {
                $maxDiscount = min($total_sum, $user->activeGiftCard->balance);
                return $maxDiscount;
            }
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

    public function getUsedPromoDiscount($total_sum = null)
    {
        $promoCode = $this->getPromo();
        $amount = 0;

        if (!$total_sum)
            $total_sum = $this->getTotalSum();

        if ($promoCode->amount) {
            $amount = $promoCode->amount;
        } elseif ($promoCode->percent) {
            if ($promoCode->type == PromoCode::TYPE_CART) {
                $amount = $total_sum * ($promoCode->percent / 100);
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

        $amount = min($amount, $total_sum);

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



    public function getGiftProducts()
    {
        $giftService = new GiftService();
        return $giftService->getGiftProducts($this->getAllProducts());
    }


}
