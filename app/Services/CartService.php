<?php

namespace App\Services;

use App\Enums\AvailableOptions;
use App\Events\OrderCreated;
use App\Models\Address;
use App\Models\Brand;
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
    const ADDRESS_KEY = 'address';
    const GIFT_BOX_KEY = 'gift_box';
    const AS_DELIVERY_ADDRESS_KEY = 'as_delivery_address';
    const CARD_KEY = 'card_id';
    const FIRST_NAME_KEY = 'first_name';
    const LAST_NAME_KEY = 'last_name';
    const PHONE_KEY = 'phone';
    const EMAIL_KEY = 'email';
    const PAYMENT_TYPE = 'payment_type';

    const BONUSES_KEY = 'cart_bonuses';
    const PROMO_KEY = 'cart_promo';


    const ADDRESS_STATE = 'state';
    const ADDRESS_CITY = 'city';
    const ADDRESS_STREET = 'street';
    const ADDRESS_HOUSE = 'house';
    const ADDRESS_ZIP = 'zip';
    const ADDRESS_APARTMENT = 'apartment';
    const ADDRESS_INTERCOM = 'intercom';
    const ADDRESS_ENTRANCE = 'entrance';
    const ADDRESS_OVER = 'over';
    const ADDRESS_BUILDING = 'building';

    const ADDRESS_SERVICE = 'service';
    const DELIVERY_POINT_ID = 'local_delivery_point_id';

    const ADDRESS_FIELDS = [
        self::ADDRESS_STATE,
        self::ADDRESS_CITY,
        self::ADDRESS_STREET,
        self::ADDRESS_HOUSE,
        self::ADDRESS_ZIP,
        self::ADDRESS_APARTMENT,
        self::ADDRESS_INTERCOM,
        self::ADDRESS_ENTRANCE,
        self::ADDRESS_OVER,
        self::ADDRESS_SERVICE,
        self::ADDRESS_BUILDING,
        self::DELIVERY_POINT_ID
    ];


    const ALL_KEYS = [
        self::ADDRESS_KEY => 'Адрес',
        self::GIFT_BOX_KEY => 'Подарочная коробка',
        self::AS_DELIVERY_ADDRESS_KEY => 'Использовать как адрес доставки',
        self::CARD_KEY => 'Карта для оплаты',
        self::FIRST_NAME_KEY => 'Имя',
        self::LAST_NAME_KEY => 'Фамилия',
        self::PHONE_KEY => 'Телефон',
        self::EMAIL_KEY => 'E-mail',
        self::PAYMENT_TYPE => 'Способ оплаты',
        self::DELIVERY_KEY => 'Способ доставки',
        self::ADDRESS_STATE => 'Область',
        self::ADDRESS_CITY => 'Город',
        self::ADDRESS_STREET => 'Улица',
        self::ADDRESS_HOUSE => 'Дом',
        self::ADDRESS_APARTMENT => 'Ктвртира/Офис',
        self::ADDRESS_ZIP => 'Индекс',
        self::ADDRESS_INTERCOM => 'Домофон',
        self::ADDRESS_ENTRANCE => 'Подъезд',
        self::ADDRESS_OVER => 'Этаж',
        self::ADDRESS_SERVICE => 'Сервис доставки',
        self::ADDRESS_BUILDING => 'Корпус/строение',
        self::DELIVERY_POINT_ID => 'local_delivery_point_id'
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

        $promo_code = null;
        if ($this->isUsedPromo())
            $promo_code = $this->getPromo();

        $products->map(function ($item) use ($cart, $promo_code) {
            $item->rraw_price = $item->price;

            if ($promo_code)
                if ($promo_code->isProductIncluded($item->id))
                    $item->price = ceil($promo_code->calculateProductPrice($promo_code->calc_on_base ? $item->rrp : $item->price));

            $item->quantity = $cart[$item->id]['quantity'] ?? 1;
            $item->total_sum = ceil($item->quantity * $item->price);
            $item->raw_total_sum = ceil($item->quantity * $item->rraw_price);
            $item->rrp_total_sum = ceil($item->quantity * $item->rrp);
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

    public function getCartProduct($product_id)
    {
        $products = $this->getAllProducts();
        return $products->where('id', $product_id)->first();
    }

    public function getRawTotalSum()
    {
        return ceil($this->getAllProducts()->sum('raw_total_sum')) ?? 0;
    }

    public function getTotalSum()
    {
        return ceil($this->getAllProducts()->sum('rrp_total_sum')) ?? 0;

        $cart = session()->get(self::SESSION_KEY, []);

        $products = $this->getAllProducts();
        $products->map(function ($item) use ($cart) {
            if ($this->isUsedPromo()) {
                $promoCode = $this->getPromo();
                if ($promoCode->calc_on_base && $promoCode->isProductIncluded($item->id)) {
                    $item->total_sum = ($cart[$item->id]['quantity'] ?? 1) * ($item->raw_old_price ?? $item->raw_price);
                } else {
                    $item->total_sum = ($cart[$item->id]['quantity'] ?? 1) * $item->price;
                }
            } else {
                $item->total_sum = ($cart[$item->id]['quantity'] ?? 1) * $item->price;
            }
        });
        $totalSum = $products->sum('total_sum');

        return round($totalSum, 2) ?? 0;
    }

    public function getTotalSumWithDiscounts($with_promo_code = true, $with_bonuses = true, $with_gift_card = true)
    {
        $total_sum = ceil($this->getAllProducts()->sum('total_sum')) ?? 1;

        if (Auth::check() && $total_sum > 1) {
            $user = Auth::user();
            $this->checkDiscount();

            if ($with_promo_code && $this->isUsedPromo()) {
                $discount = $this->getUsedPromoDiscount();
                $this->discounts['promo_code'] = [
                    'title' => "Промокод {$this->getPromoCode()}",
                    'amount' => $discount
                ];
//                $total_sum = $this->getTotalSumWithUsedPromo($discount);
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

        return max(1, ceil($total_sum));

        $total_sum = round($total_sum, 2) ?? 1;

        return $total_sum > 0 ? $total_sum : 1;
    }

    public function getBonusAmount()
    {
        $bonus_points = 0;
        $totalSum = $this->getTotalSumWithDiscounts();

        $minSumForBonuses = (int) SiteConfigService::getParamValue('min_checkout_sum_for_bonuses');
        if ($totalSum < $minSumForBonuses)
            return 0;

        foreach (self::getAllProducts() as $product) {
            if ($product->points > 0)
                $bonus_points += $product->points * $product->quantity;
        }

        if ($this->isUsedBonuses()) {
            $usedBonuses = $this->getUsedBonusesDiscount();
            $usedBonusesPercent = round(($usedBonuses / $this->getTotalSumWithDiscounts()) * 100);

            $bonus_points -= ($bonus_points * $usedBonusesPercent) / 100;
        }

        return floor($bonus_points);
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
            return !$item->isAvailable();
        });
    }

    public static function canCheckout(): bool
    {
        $cartService = new self();

        if ($cartService->containUnavailable())
            return false;

        $total_sum = $cartService->getTotalSum();

        $min_sum = SiteConfigService::getParamValue('min_checkout_sum');
        if ($min_sum && $total_sum < $min_sum)
            return false;

        $max_sum = SiteConfigService::getParamValue('max_checkout_sum');
        if ($max_sum && $total_sum > $max_sum)
            return false;

        return true;
    }

    public function canNotCheckoutMessage(): ?string
    {
        if ($this->containUnavailable())
            return 'Невозможно оформить заказ, так как в корзине присутствует товар который больше недоступен';

        $total_sum = $this->getTotalSum();

        $min_sum = SiteConfigService::getParamValue('min_checkout_sum');
        if ($min_sum && $total_sum < $min_sum)
            return 'Минимальная сумма для заказа ' . $min_sum;

        $max_sum = SiteConfigService::getParamValue('max_checkout_sum');
        if ($max_sum && $total_sum > $max_sum)
            return 'Максимальная сумма для заказа ' . $max_sum;

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

    public function store(): ?Order
    {
        if (!self::isNotEmpty())
            return null;

        $user = Auth::user();
        $user->update([
            'name' => $this->getProperty(self::FIRST_NAME_KEY),
            'surname' => $this->getProperty(self::LAST_NAME_KEY),
            'email' => $this->getProperty(self::EMAIL_KEY),
        ]);

        $order_data = Arr::mapWithKeys(self::ALL_KEYS, function ($title, $name) {
            return [$name => $this->getProperty($name)];
        });
        $order_data['user_id'] = $user->id;
        $order_data['total_sum'] = self::getTotalSumWithDiscounts();
        $order_data['full_name'] = $this->getProperty(self::FIRST_NAME_KEY) . ' ' . $this->getProperty(self::LAST_NAME_KEY);
        $order_data['phone'] = $user->phone;
        $order_data['promo_code_discount'] = null;
        $order_data['bonuses_discount'] = null;
        $order_data['gift_card_discount'] = null;
        $order_data['gift_box'] ??= false;

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
                    'old_price' => $product->rrp
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

            OrderCreated::dispatch($order);

            return $order;
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

        $total_cart_sum = ceil($this->getAllProducts()->sum('total_sum')) ?? 1;
        $bonuses_per_order = (int) SiteConfigService::getParamValue('bonuses_per_order') ?? 0;
        if ($bonuses_per_order > 0) {
            $max_bonuses_for_current_checkout = floor(($bonuses_per_order / 100) * $total_cart_sum);
        } else {
            $max_bonuses_for_current_checkout = 0;
        }

        $error_message = SiteConfigService::getParamValue('checkout_max_bonuses_error_message');
        $error_message = \Str::replace([
            '{bonuses_per_order}',
            '{max_bonuses_for_current_checkout}',
        ], [
            $bonuses_per_order,
            $max_bonuses_for_current_checkout,
        ], $error_message);

        if ($max_bonuses_for_current_checkout < $amount)
            throw new Exception($error_message);

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

        $total_sum = $promoCode->calc_on_base
            ? $this->getTotalSum()
            : $this->getRawTotalSum();

        if ($promoCode->amount) {
            $amount = $promoCode->amount;
        } elseif ($promoCode->percent) {
            if ($promoCode->type == PromoCode::TYPE_CART) {
                $amount = $total_sum * ($promoCode->percent / 100);
            } elseif ($promoCode->type == PromoCode::TYPE_CATEGORY) {
                $category_ids = Category::getChildIds($promoCode->caseCategories()->pluck('model_id')->values()->toArray());
                $products = $this->getAllProducts($category_ids);
                $temp_sum = $products->sum('total_sum');
                $amount = $temp_sum * ($promoCode->percent / 100);
            } elseif ($promoCode->type == PromoCode::TYPE_PRODUCT) {
                $product = $this->getAllProducts()->whereIn('id', $promoCode->caseProducts()->pluck('model_id')->values()->toArray())->first();
                $amount = $product->total_sum * ($promoCode->percent / 100);
            } elseif ($promoCode->type == PromoCode::TYPE_BRAND) {
                $product = $this->getAllProducts()->whereIn('brand_id', $promoCode->caseBrands()->pluck('model_id')->values()->toArray())->first();
                $amount = $product->total_sum * ($promoCode->percent / 100);
            }
        }

        return floor(min($amount, $total_sum));
    }

    public function getTotalSumWithUsedPromo($discount)
    {
        $promoCode = $this->getPromo();

        return $this->getTotalSum() - $discount;
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

        if (!$promoCode->isAvailableForUser(Auth::id()))
            throw new Exception('Вы уже использовали этот промокод');

        if ($promoCode->type == PromoCode::TYPE_CART) {
            if ($promoCode->min_sum && $promoCode->min_sum > $this->getTotalSum())
                throw new Exception("Сумма в корзине должна быть не меньше {$promoCode->min_sum} для использования этого промокода");
        } elseif ($promoCode->type == PromoCode::TYPE_PRODUCT) {
            $productIds = $promoCode->caseProducts()->pluck('model_id')->values()->toArray();
            if(count(array_intersect($productIds, $this->getAllProducts()->pluck('id')->toArray())) < 1) {
                $productTitles = Product::whereIn('id', $productIds)->pluck('title')->join(', ');
                throw new Exception("Прмокод действует только на товары '{$productTitles}'");
            }
        } elseif ($promoCode->type == PromoCode::TYPE_CATEGORY) {
            $baseCategoriesIds = $promoCode->caseCategories()->pluck('model_id')->values()->toArray();
            $categoryIds = Category::getChildIds($baseCategoriesIds);

            if (!$this->checkCategoryInCart($categoryIds)) {
                $categoryTitles = Category::whereIn('id', $baseCategoriesIds)->pluck('name')->join(', ');
                throw new Exception("Прмокод действует только на категориях '{$categoryTitles}' и сопутствующих");
            }
        } elseif ($promoCode->type == PromoCode::TYPE_BRAND) {
            $brandIds = $promoCode->caseBrands()->pluck('model_id')->values()->toArray();

            if (!$this->checkBrandInCart($brandIds)) {
                $brandTitles = Brand::whereIn('id', $brandIds)->pluck('name')->join(', ');
                throw new Exception("Прмокод действует только на бренды '{$brandTitles}'");
            }
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

    public function checkBrandInCart(array $brand_ids): bool
    {
        $products = $this->getAllProducts();
        foreach ($products as $product) {
            $product_brands[] = $product->brand_id;
            foreach ($product_brands as $product_category_id) {
                if (in_array($product_category_id, $brand_ids))
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

    public function getUserBonusesMessage(): string
    {
        $message = SiteConfigService::getParamValue('user_bonuses_message');
        $bonuses_per_order = (int) SiteConfigService::getParamValue('bonuses_per_order') ?? 0;
        $bonuses = auth()->user()->points ?? 0;

        return \Str::replace([
            '{bonuses}',
            '{bonuses_per_order}',
        ], [
            $bonuses,
            $bonuses_per_order,
        ], $message);

    }


    public function getProductPrice(Product $product)
    {
        if ($this->isUsedPromo()) {
            $promoCode = $this->getPromo();

            if ($promoCode->calc_on_base && $promoCode->isProductIncluded($product->id))
                return $product->raw_old_price ?? $product->raw_price;
        }

        return $product->price;
    }


}
