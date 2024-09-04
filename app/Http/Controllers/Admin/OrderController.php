<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GiftCardValue;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Services\GiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderController extends Controller
{

    public function __construct(private GiftService $giftService)
    {
        $this->authorizeResource(Order::class, 'order');
    }

    public function index(Request $request)
    {
        $query = Order::orderBy('id', 'DESC')->with('user');
        $statuses = OrderStatus::all();

        if ($request->has('status_id') && $request->get('status_id') != '')
            $query->whereIn('status_id', $request->get('status_id'));
        if ($request->has('customer') && $request->get('customer') != '') {
            $customer = $request->get('customer');
            $query->where(function ($query) use ($customer) {
                $query->orWhere('phone', 'LIKE', "%{$customer}%")
                    ->orWhere(function ($query) use ($customer) {
                        $query->whereHas('user', function ($query) use ($customer) {
                            $query->where('users.name', 'LIKE', "%{$customer}%")
                                ->orWhere('users.email', 'LIKE', "%{$customer}%")
                                ->orWhere('users.phone', 'LIKE', "%{$customer}%");
                        });
                    });
            });
        }

        if ($request->has('sum_from') && $request->get('sum_from') != '')
            $query->where('total_sum', '>=', $request->get('sum_from'));
        if ($request->has('sum_to') && $request->get('sum_to') != '')
            $query->where('total_sum', '<=', $request->get('sum_to'));

        $discount_from = $request->get('discount_from', '');
        $discount_to = $request->get('discount_to', '');
        if ($discount_from != '' || $discount_to != '') {
            $query->where(function ($subquery) use ($discount_from, $discount_to) {
                if ($discount_from != '')
                    $subquery->whereRaw('(`gift_card_discount` + `bonuses_discount` + `promo_code_discount`) >= ?', [$discount_from]);

                if ($discount_to != '') {
                    if ($discount_to == '0') {
                        $subquery->whereNull('gift_card_discount')
                            ->whereNull('bonuses_discount')
                            ->whereNull('promo_code_discount');
                    } else {
                        $subquery->whereRaw('(`gift_card_discount` + `bonuses_discount` + `promo_code_discount`) <= ?', [$discount_to]);
                    }
                }
            });
        }

        if ($request->has('date_from') && $request->get('date_from') != '')
            $query->where('created_at', '>=', $request->get('date_from'));
        if ($request->has('date_to') && $request->get('date_to') != '')
            $query->where('created_at', '<=', $request->get('date_to'));

        $orders = $query->paginate($request->get('per_page') ?? 10);
        $current_sum = $query->sum('total_sum');

        if ($request->ajax())
            return view('admin.orders.includes.table', compact('orders', 'statuses', 'current_sum'))->render();

        $total_sum = Order::completed()->sum('total_sum');
        $total_sum_current_month = Order::currentMonth()->completed()->sum('total_sum');
        $total_sum_today = Order::today()->completed()->sum('total_sum');

        return view('admin.orders.index', compact(
            'orders',
            'statuses',
            'total_sum',
            'total_sum_current_month',
            'total_sum_today',
            'current_sum'
        ));
    }

    public function create()
    {
        return view('admin.orders.create', [
            'order' => new Order(),
            'gift_products' => $this->giftService->getGiftProducts(new Collection())
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->post();
        $data['as_delivery_address'] = $request->boolean('as_delivery_address');
        $data['gift_box'] = $request->boolean('gift_box');
        $data['is_received_by_1c'] = $request->boolean('is_received_by_1c');
        $orderProducts = collect($data['products']);
        unset($data['products']);

        $data['total_sum'] = $orderProducts->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
        $data['bonuses_discount'] = $request->get('bonuses_discount', 0);
        $data['total_sum'] -= $data['bonuses_discount'];

        try {
            $order = Order::create($data);

            if ($data['bonuses_discount'] > 0)
                $order->user->decrement('points', $data['bonuses_discount']);

            foreach ($orderProducts as $orderProduct) {
                $newProduct = [
                    'order_id' => $order->id,
                    'product_id' => $orderProduct['product_id'],
                    'quantity' => $orderProduct['quantity'],
                    'price' => $orderProduct['price'],
                ];
                if (isset($orderProduct['old_price']))
                    $newProduct['old_price'] = $orderProduct['old_price'];

                OrderProduct::create($newProduct);
            }

            $order->orderGiftProducts()
                ->createMany(
                    $this->giftService
                        ->getGiftProducts($order->products)
                        ->map(function ($item) {
                            return ['gift_product_id' => $item->id];
                        })
                );

            return redirect()->route('admin.orders.edit', $order)
                ->with('success', 'Заказ успешно создан');
        } catch (\Exception $exception) {
            return back()->withErrors(["ОШИБКА: {$exception->getMessage()}"]);
        }
    }

    public function show(Request $request, Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order,
            'colors' => GiftCardValue::whereNotNull('color_card')->get(),
            'categories' => Category::all(),
            'products' => Product::all()
        ]);
    }

    public function edit(Order $order)
    {
        if ($order->isCompleted())
            return redirect()->route('admin.orders.show', $order);

        return view('admin.orders.edit', [
            'order' => $order,
            'gift_products' => $this->giftService->getGiftProducts($order->products)
        ]);
    }

    public function update(Request $request, Order $order)
    {
        if ($order->isCompleted())
            return back()->with('error', 'Заказ уже завершен');

        $data = $request->post();
        $data['as_delivery_address'] = $request->boolean('as_delivery_address');
        $data['gift_box'] = $request->boolean('gift_box');
        $data['is_received_by_1c'] = $request->boolean('is_received_by_1c');
        $orderProducts = collect($data['products']);
        unset($data['products']);

        foreach ($orderProducts as $orderProduct) {
            if (isset($orderProduct['id'])) {
                $product = OrderProduct::find($orderProduct['id']);
                $product->update(['quantity' => $orderProduct['quantity']]);
            } else {
                $newProduct = [
                    'order_id' => $order->id,
                    'product_id' => $orderProduct['product_id'],
                    'quantity' => $orderProduct['quantity'],
                    'price' => $orderProduct['price'],
                ];
                if (isset($orderProduct['old_price']))
                    $newProduct['old_price'] = $orderProduct['old_price'];

                OrderProduct::create($newProduct);
            }
        }

        $data['total_sum'] = $orderProducts->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });

        $order->update($data);

        $order->orderGiftProducts()->delete();
        $order->orderGiftProducts()
            ->createMany(
                $this->giftService
                    ->getGiftProducts($order->products)
                    ->map(function ($item) {
                        return ['gift_product_id' => $item->id];
                    })
            );

        return back()->with('success', 'Заказ успешно обновлён');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        if ($order->isCompleted())
            return ['completed' => true];

        $order->update(['status_id' => $request->post('status_id')]);
        if ($order->isCompleted())
            $order->user->increment('points', $order->bonuses_given);

        return ['completed' => $order->isCompleted()];
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        return back()->with('success', "Заказ №{$order->id} удален");
    }

    public function export(Request $request)
    {
        $orders = Order::whereIn('id', explode(',', $request->post('ids', '')))->get();
        if ($orders->isNotEmpty())
            return \Excel::download(new OrdersExport($orders), 'orders.xlsx');

        return back()->with('error', 'Нечего експортировать');
    }

}
