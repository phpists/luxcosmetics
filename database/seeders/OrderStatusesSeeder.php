<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_statuses')->truncate();

        $statuses = [
            [
                'title' => 'Новый',
                'color' => '#42d7d4',
            ],
            [
                'title' => 'Оплачен',
                'color' => '#65d77e',
            ],
            [
                'title' => 'Принят LMS',
                'color' => '#a61879',
            ],
            [
                'title' => 'Доставлен в ПВЗ',
                'color' => '#5e18a6',
            ],
            [
                'title' => 'Завершён',
                'color' => '#6182f9',
            ],
            [
                'title' => 'Отменён',
                'color' => '#ec6d6d',
            ],
        ];

        foreach ($statuses as $status) {
            $new_status = new OrderStatus();
            $new_status->title = $status['title'];
            $new_status->color = $status['color'];
            $new_status->is_system = 1;
            $new_status->save();
        }

    }
}
