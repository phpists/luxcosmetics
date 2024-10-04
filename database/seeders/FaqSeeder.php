<?php

namespace Database\Seeders;

use App\Models\FaqGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'Подарочные карты'
        ];

        foreach ($groups as $pos => $group) {
            FaqGroup::firstOrCreate([
                'name' => $group,
                'position' => $pos,
                'is_active' => true
            ]);
        }
    }
}
