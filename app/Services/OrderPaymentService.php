<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class OrderPaymentService
{

    public Client $client;

    private string $server_url;
    private string $username;
    private string $password;


    public function __construct(public Order $order)
    {
        $this->client = new Client();

        $this->server_url = config('paykeeper.server_url');
        $this->username = config('paykeeper.username');
        $this->password = config('paykeeper.password');
    }

    public function renderForm()
    {
        $response = $this->client->post($this->server_url, [
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

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    final public function getPaymentUrl(): string
    {
        $params = [
            "pay_amount" => $this->order->total_sum,
            "clientid" => $this->order->full_name,
            "orderid" => $this->order->num,
            "client_email" => $this->order->email,
            "client_phone" => $this->order->phone
        ];

        $auth_token = base64_encode("$this->username:$this->password");

        $token_response = $this->client->get($this->server_url . '/info/settings/token/', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => "Basic {$auth_token}"
            ],
            'form_params' => $params
        ]);

        $data = json_decode($token_response->getBody()->getContents(), true);
        if (!isset($data['token'])) {
            throw new Exception('Не удалось инициализировать платеж! Попробуйте еще раз');
        }

        $params['token'] = $data['token'];

        $invoice_response = $this->client->post($this->server_url . '/change/invoice/preview/', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => "Basic {$auth_token}"
            ],
            'form_params' => $params
        ]);

        $invoice_response = json_decode($invoice_response->getBody()->getContents(), true);

        if (!isset($invoice_response['invoice_id']))
            throw new Exception('Не удалось инициализировать платеж! Попробуйте еще раз');

        $this->order->update(['invoice_id' => $invoice_response['invoice_id']]);

        return $this->order->getPaymentUrl();
    }


}
