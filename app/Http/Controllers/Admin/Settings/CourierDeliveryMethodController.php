<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\CourierDeliveryMethod;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class CourierDeliveryMethodController extends Controller
{

    public function index()
    {
        return view('admin.settings.courier-delivery-methods.index', [
            'models' => CourierDeliveryMethod::all(),
            'deliveryMethods' => DeliveryMethod::all()
        ]);
    }

    public function store(Request $request)
    {
        $courier = new CourierDeliveryMethod($request->post());
        if ($courier->save()) {
            return to_route('admin.courier-delivery-methods.index')->with('success', 'Данные успешно сохранены');
        }

        return back()->with('error', 'Не удалось сохраненить данные');
    }

    public function show(Request $request, CourierDeliveryMethod $courierDeliveryMethod)
    {
        return $courierDeliveryMethod;
    }


    public function update(Request $request, CourierDeliveryMethod $courierDeliveryMethod)
    {
        $courierDeliveryMethod->fill($request->post());
        if ($courierDeliveryMethod->update()) {
            return to_route('admin.courier-delivery-methods.index')->with('success', 'Данные успешно сохранены');
        }

        return back()->with('error', 'Не удалось сохраненить данные');
    }

    public function destroy(Request $request, CourierDeliveryMethod $courierDeliveryMethod)
    {
        if ($courierDeliveryMethod->delete())
            return to_route('admin.courier-delivery-methods.index')->with('success', 'Запись удалено');

        return back()->with('error', 'Не удалось удалить запись');
    }

    public function getStates(Request $request)
    {
        return [
            'data' => [
                'results' => [
                    'Московская область',
                    'Белгородская область',
                    'Воронежская область',
                ]
            ]
        ];
    }

    public function getCities(Request $request)
    {
        return [
            'data' => [
                'results' => [
                    'Москва',
                    'Санкт-Петербург',
                    'Воронеж',
                    'Белгород'
                ]
            ]
        ];
    }

}
