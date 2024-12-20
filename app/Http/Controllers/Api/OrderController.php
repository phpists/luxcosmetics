<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderChangeStatusRequest;
use App\Http\Requests\Api\OrderReceivedBy1cRequest;
use App\Http\Resources\New1COrdersResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\Api\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(public OrderService $orderService)
    {
    }

    public function getNewOrders()
    {
        $orders = Order::newFor1C()
            ->with(['orderProducts', 'giftProducts:article'])
            ->get();

        return new New1COrdersResource($orders);
    }

    public function changeStatus(OrderChangeStatusRequest $request, Order $order)
    {
        try {
            $this->orderService->changeStatus($request->validated(), $order);
            return new JsonResponse(['result' => 'success']);
        } catch (\Exception $e) {
            return new JsonResponse(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function receiveBy1c(OrderReceivedBy1cRequest $request, Order $order)
    {
        try {
            $this->orderService->receiveBy1c($order, $request->validated('is_received'));
            return new JsonResponse(['result' => 'success']);
        } catch (\Exception $e) {
            return new JsonResponse(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

}
