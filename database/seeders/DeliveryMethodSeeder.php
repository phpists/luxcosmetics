<?php

namespace Database\Seeders;

use App\Enums\DeliveryMethodEnum;
use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => DeliveryMethodEnum::CDEK->value,
                'title' => 'СДЭК'
            ],
            [
                'name' => DeliveryMethodEnum::BOXBERRY->value,
                'title' => 'Boxberry'
            ],
            [
                'name' => DeliveryMethodEnum::DPD->value,
                'title' => 'DPD'
            ],
            [
                'name' => DeliveryMethodEnum::RUSSIA_POST->value,
                'title' => 'Почта России'
            ],
            [
                'name' => DeliveryMethodEnum::FIVEPOST->value,
                'title' => '5Post'
            ],
            [
                'name' => DeliveryMethodEnum::LOGSIS->value,
                'title' => 'Logsis'
            ],
        ];

        foreach ($services as $i => $service) {
            if (!DeliveryMethod::whereName($service['name'])->exists()) {
                $service['pos'] = $i;
                DeliveryMethod::create($service);
            }
        }
    }
}
