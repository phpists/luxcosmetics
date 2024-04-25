<?php

namespace App\Console\Commands;

use App\Models\DeliveryPoint;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;

class ImportDeliveryPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update DeliveryPoint`s from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(3600);

        $client = new Client();
        $token = config('api.fm_logistics_token');

        $request = new Request(
            'POST',
            'https://ecom.fmlogistic.com/services/merchant/getAddress/all',
            [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            '{}'
        );
//        $response = $client->post('https://ecom.fmlogistic.com/services/merchant/getAddress/all', [
//            'headers' => [
//                'Authorization' => "Bearer {$token}"
//            ],
//            'json' => []
//        ]);

        $response = $client->sendAsync($request)->wait();
        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data['pointsList'] ?? [] as $datum) {
            foreach ($datum as $i => $value)
                if (!is_string($value))
                    $datum[$i] = json_encode($value);

            DeliveryPoint::firstOrCreate([
                'lms' => $datum['lms'],
                'pointId' => $datum['pointId'],
                'pointCode' => $datum['pointCode'],
            ], $datum);
        }

        $this->call('delivery:sync');
    }
}
