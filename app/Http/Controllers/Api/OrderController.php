<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderChangeStatusRequest;
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
        return new JsonResponse([
            'orders' => $this->orderService->getNewOrders()
        ]);
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

}
