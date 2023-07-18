<?php

namespace App\Services;

use App\Mail\CertificateMail;
use App\Mail\CertificateUserEmail;
use App\Mail\OrderUserMail;
use App\Models\ActionProduct;
use App\Models\Certificate;
use App\Models\CertificatesUser;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\Promocode;
use App\Models\PropertyData;
use App\Models\User;
use App\Services\CurrencyService;
use App\Services\LanguageService;
use App\Services\Payment\LiqPay\LiqPay;
use App\Services\Payment\Portmone\Portmone;
use App\Services\SalesDoubler\SalesDoublerService;
use App\Services\Soap\CertificateService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartService
{

    const SESSION_KEY = 'cart';

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
            if (isset($item->baseValue->id))
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

    public function getTotalCount(): int
    {
        return count(self::getAllItems());
    }

    public function isNotEmpty(): bool
    {
        return self::getTotalCount() > 0;
    }

    public function add($product_id)
    {
        $cart = session()->get(self::SESSION_KEY, []);
        if (!isset($cart[$product_id]) && $this->canAdd($product_id)) {
            $cart[$product_id] = [
                'product_id' => $product_id,
                'quantity' => 1,
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

}
