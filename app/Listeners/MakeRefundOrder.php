<?php

namespace App\Listeners;

use App\Events\OrderCancelled;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use function Symfony\Component\Translation\t;

class MakeRefundOrder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCancelled $event): void
    {
        $order = $event->order;
        $client = new Client();

        try {
            $infoResponse = $client->get("https://luxecosmetics.server.paykeeper.ru/info/invoice/byid/?id={$order->invoice_id}");
            if ($infoResponse->getStatusCode() != 200)
                abort(500, 'Can not get invoice information!');

            $paymentId = json_decode($infoResponse->getBody()->getContents(), true)['payment_id'] ?? null;
            if (!$paymentId)
                abort(500, 'Invoice info not contain payment_id!');

            $tokenResponse = $client->get("https://luxecosmetics.server.paykeeper.ru/info/settings/token/");
            $token = json_decode($tokenResponse->getBody()->getContents(), true)['token'] ?? null;
            if (!$token)
                abort(500, 'Can not get token!');

            $response = $client->post("https://luxecosmetics.server.paykeeper.ru/change/payment/reverse/", [
                'query' => [
                    'id' => $paymentId,
                    'amount' => $order->total_sum,
                    'partial' => false,
                    'token' => $token,
                    'refund_cart' => []
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if (isset($result['status']) && $result['status'] == true) {
                \Log::info("Order #{$order->id} was successful refunded");
            } else {
                \Log::error("Failed to refund order #{$order->id}!");
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
