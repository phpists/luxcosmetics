<?php

namespace App\Http\Controllers;

use App\Mail\OrderLetter;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\PromoCode;
use App\Services\CartService;
use App\Services\SiteConfigService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __construct(private readonly CartService $cartService)
    {}


    public function index() {
        $cart_products = $this->cartService->getAllProducts();

        if ($cart_products->isNotEmpty()) {
            return view('cart.index', compact('cart_products'));
        } else {
            return view('cart.empty');
        }
    }

    public function indexStore(Request $request)
    {
        if (!Auth::check())
            return to_route('cart.login');

        $gift_box = $request->boolean(CartService::GIFT_BOX_KEY);
        $this->cartService->setProperty(CartService::GIFT_BOX_KEY, $gift_box);

        return redirect()->route('cart.delivery');
    }

    public function login() {
        return view('cart.login');
    }

    public function delivery()
    {
        if (!$this->cartService->isNotEmpty())
            return redirect()->route('home');

        return view('cart.delivery');
    }

    public function deliveryStore(Request $request)
    {
        $address = $request->post('address');
        $this->cartService->setProperty(CartService::ADDRESS_KEY, $address);
        $delivery_type = $request->post('delivery_type');
        $this->cartService->setProperty(CartService::DELIVERY_KEY, $delivery_type);
        $first_name = $request->post('first_name');
        $this->cartService->setProperty(CartService::FIRST_NAME_KEY, $first_name);
        $last_name = $request->post('last_name');
        $this->cartService->setProperty(CartService::LAST_NAME_KEY, $last_name);
        $email = $request->post('email', Auth::user()->email);
        $this->cartService->setProperty(CartService::EMAIL_KEY, $email);
        $phone = Auth::user()->phone;
        $this->cartService->setProperty(CartService::PHONE_KEY, $phone);

        foreach (CartService::ADDRESS_FIELDS as $address_field) {
            $this->cartService->setProperty($address_field, $request->post($address_field));
        }


        return redirect()->route('cart.payment');
    }

    public function payment()
    {
        if (!$this->cartService->isNotEmpty())
            return redirect()->route('home');

        $address = $this->cartService->getProperty(CartService::ADDRESS_KEY);

        return view('cart.payment', compact('address'));
    }

    public function checkoutStore(Request $request)
    {
        if (!CartService::canCheckout())
            return back()->with('error', 'Ошибка! Не удалось оформить заказ - пожалуйста, попробуйте ещё раз');

        $as_delivery_address = $request->boolean('as_delivery_address');
        $this->cartService->setProperty(CartService::AS_DELIVERY_ADDRESS_KEY, $as_delivery_address);

        $payment_type = $request->post('payment_type');
        $this->cartService->setProperty(CartService::PAYMENT_TYPE, $payment_type);

        $user = Auth::user();
        $email = $user->email;

//        $card_id = $request->post('card_id');
//        if (!$card_id) {
//            $card_data = $request->post('card');
//            $card_data['card_number'] = trim($card_data['card_number']);
//            $card_data['valid_date'] = $card_data['month'].'/'.$card_data['year'];
//            $card_data['cvv'] = Hash::make($card_data['cvv']);
//            $card_data['is_default'] = $request->boolean('cart.is_default');
//            $card_data['user_id'] = Auth::id();
//            $card = PaymentCard::create($card_data);
//            $card_id = $card->id;
//        }
//
//        $this->cartService->setProperty(CartService::CARD_KEY, $card_id);

        if ($order = $this->cartService->store()) {
            // Send mail to user
            Mail::to($email)->send(new OrderLetter('Спасибо за оформление заказа', $order->status?->title ?? "Новый"));

            if ($payment_type == Order::PAYMENT_ONLINE || $payment_type == Order::PAYMENT_SBP) {
                return to_route('orders.payment', $order);
            }
        }

        return redirect()->route('cart.error');
    }

    public function success(Order $order)
    {
        return view('cart.success', compact('order'));
    }

    public function error()
    {
        return view('cart.error', [
            'page' => Page::whereLink('cart/error')->first()
        ]);
    }


    public function add(Request $request)
    {
        $this->cartService->add($request->post('product_id'));
        $total_count = $this->cartService->getTotalCount();
        return response()->json([
            'total_count' => $total_count,
            'product_html' => view('layouts.includes._purchase_modal_product', [
                'product' => Product::find($request->post('product_id'))
            ])->render()
        ]);
    }

    public function remove(Request $request)
    {
        $this->cartService->remove($request->post('product_id'));
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'total_count' => $total_count,
            'total_sum' => $total_sum,
            'total_block' => view('cart.includes.total_sum')->render(),
            'can_checkout' => CartService::canCheckout(),
            'cant_checkout_message' => $this->cartService->canNotCheckoutMessage()
        ]);
    }

    public function plusQuantity(Request $request)
    {
        $quantity = $this->cartService->plusQuantity($request->post('product_id'));
        $sum = round((Product::find($request->post('product_id')))->price * $quantity, 2);
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'quantity' => $quantity,
            'sum' => $sum,
            'total_count' => $total_count,
            'total_sum' => $total_sum,
            'total_block' => view('cart.includes.total_sum')->render(),
            'can_checkout' => CartService::canCheckout(),
            'cant_checkout_message' => $this->cartService->canNotCheckoutMessage()
        ]);
    }

    public function minusQuantity(Request $request)
    {
        $quantity = $this->cartService->minusQuantity($request->post('product_id'));
        $sum = round((Product::find($request->post('product_id')))->price * $quantity, 2);
        $total_count = $this->cartService->getTotalCount();
        $total_sum = $this->cartService->getTotalSum();

        return response()->json([
            'quantity' => $quantity,
            'sum' => $sum,
            'total_count' => $total_count,
            'total_sum' => $total_sum,
            'total_block' => view('cart.includes.total_sum')->render(),
            'can_checkout' => CartService::canCheckout(),
            'cant_checkout_message' => $this->cartService->canNotCheckoutMessage()
        ]);
    }

    public function clear()
    {
        $this->cartService->clear();

        return back();
    }



    public function useBonuses(Request $request)
    {
        $amount = (float) $request->post('amount', 0);
        $user = Auth::user();
        $total_sum_without_gift_card = $this->cartService->getTotalSumWithDiscounts(true, false, false);

        if ($amount > 0) {
            try {
                if ($total_sum_without_gift_card < 1
                    || $total_sum_without_gift_card < $amount)
                    throw new Exception('Общая сумма заказа не может быть меньше 0');

                $this->cartService->verifyBonusesConditions($amount);
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }

            $this->cartService->useBonuses($amount);
            return back()->with('success', 'Бонусы успешно применены');
        } else {
            $this->cartService->dropBonuses();
            return back()->with('error', 'Бонусы больше не используются');
        }
    }

    public function usePromo(Request $request)
    {
        if ($request->post('code') == null) {
            $this->cartService->dropPromo();
            return back();
        }

        $promoCode = PromoCode::active()->where('code', $request->post('code'))->first();

        if (!$promoCode)
            return back()->with('error', 'Такого промо кода не существует');

        try {
            $this->cartService->verifyPromoConditions($promoCode);

//            if ($promoCode->amount && (($this->cartService->getTotalSumWithDiscounts() - $promoCode->amount) < 0))
//                throw new Exception('Общая сумма заказа не может быть меньше 0');

            $this->cartService->usePromo($promoCode->code);

            return back()->with('success', 'Промокод успешно применён');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    public function gifts(Request $request)
    {
        if ($request->ajax())
            return view('cart.includes.gifts', [
                'gift_products' => $this->cartService->getGiftProducts()
            ]);

        return to_route('cart');
    }

    public function updateSessionValue(Request $request)
    {
        $this->cartService->setProperty($request->post('name'), $request->post('value'));
    }
}
