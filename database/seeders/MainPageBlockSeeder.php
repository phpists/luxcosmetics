<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainPageBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('main_page_block')->insert([[
            'title' => 'Мастер-класс от эксперта',
            'content' => '<p>Приобретите косметические продукты на сумму свыше 7000 рублей и получите доступ к эксклюзивному видео-мастер-классу от известного визажиста!</p><p>Узнайте секреты профессионалов и научитесь создавать неповторимые образы с помощью наших качественных средств. Ваша красота – в ваших руках!</p>',
            'video_path' => 'fireplace_-_1971 (720p).mp4',
            'image_path' => 'video-cover.jpg'
        ]]);
    }
}
