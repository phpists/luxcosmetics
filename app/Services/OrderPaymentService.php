<?php

namespace App\Services;

use App\Models\Order;
use GuzzleHttp\Client;

class OrderPaymentService
{

    const SERVER_URL = 'https://luxecosmetics.server.paykeeper.ru/order/inline/';


    public function __construct(public Order $order)
    {
    }

    public function renderForm()
    {
        $client = new Client();
        $response = $client->post(self::SERVER_URL, [
            'form_params' => [
                'orderid' => $this->order->num,
                'sum' => $this->order->total_sum,
                'clientid' => $this->order->full_name,
                'client_email' => $this->order->email,
                'client_phone' => $this->order->phone
            ]
        ]);

        return $response->getBody();
    }

    public function confirmPayment(): bool
    {
        $this->order->status_id = Order::STATUS_PAYED;
        return $this->order->save();
    }

}
