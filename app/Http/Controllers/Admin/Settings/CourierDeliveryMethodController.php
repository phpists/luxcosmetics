<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\CourierDeliveryMethod;
use App\Models\DeliveryMethod;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CourierDeliveryMethodController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(CourierDeliveryMethod::class);
    }

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
        $client = new Client();
        $response = $client->post('https://suggest-maps.yandex.ru/v1/suggest', [
            'query' => $request->all()
        ]);

        $result = json_decode($response->getBody()->getContents(), true) ?? [];

        if (isset($result['results'])) {
            $result = \Arr::map($result['results'], function ($item) {
                return $item['title']['text'];
            });
        }

        return $result;
    }

    public function getCities(Request $request)
    {
        $client = new Client();
        $response = $client->post('https://suggest-maps.yandex.ru/v1/suggest', [
            'query' => $request->all()
        ]);

        $result = json_decode($response->getBody()->getContents(), true) ?? [];

        if (isset($result['results'])) {
            $result = \Arr::map($result['results'], function ($item) {
                return $item['title']['text'];
            });
        }

        return $result;
    }

}
