<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyStatus;
use Illuminate\Http\Request;

class LoyaltyStatusController extends Controller
{
    public function index()
    {
        return view('admin.loyalty-statuses.index', [
            'loyaltyStatuses' => LoyaltyStatus::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_over_pp'] = isset($data['is_over_pp']) ? 1 : 0;

        LoyaltyStatus::create($data);

        return to_route('admin.loyalty-statuses.index')
            ->with('success', 'Статус успешно создан');
    }

    public function show(LoyaltyStatus $loyaltyStatus)
    {
        return $loyaltyStatus;
    }

    public function update(Request $request, LoyaltyStatus $loyaltyStatus)
    {
        $data = $request->all();
        $data['is_over_pp'] = isset($data['is_over_pp']) ? 1 : 0;

        $loyaltyStatus->update($data);

        return to_route('admin.loyalty-statuses.index')
            ->with('success', 'Статус успешно обновлен');
    }

    public function destroy(LoyaltyStatus $loyaltyStatus)
    {
        $loyaltyStatus->delete();

        return to_route('admin.loyalty-statuses.index')
            ->with('success', 'Статус успешно удален');
    }
}
