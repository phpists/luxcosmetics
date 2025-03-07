<?php

namespace Database\Seeders;

use App\Models\LoyaltyStatus;
use Illuminate\Database\Seeder;

class LoyaltyStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            [
                'title' => 'Джуниор',
                'achieve_sum' => 0,
                'discount_percent' => 10,
            ],
        ];

        foreach ($statuses as $status)
            LoyaltyStatus::create($status);
    }
}
