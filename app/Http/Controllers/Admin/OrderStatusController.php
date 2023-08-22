<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{

    public function index()
    {
        return view('admin.order-statuses.index', [
            'statuses' => OrderStatus::all()
        ]);
    }

    public function store(Request $request)
    {
        OrderStatus::create($request->post());
        return back()->with('success', 'Статус добавлен');
    }

    public function show(Request $request, OrderStatus $orderStatus)
    {
        if ($request->wantsJson())
            return $orderStatus;

        return back();
    }

    public function update(Request $request, OrderStatus $orderStatus)
    {
        $orderStatus->update($request->post());
        return back()->with('success', 'Статус обновлён');
    }

    public function destroy(Request $request, OrderStatus $orderStatus)
    {
        $orderStatus->delete();
        return back()->with('success', 'Статус удалён');
    }

}
