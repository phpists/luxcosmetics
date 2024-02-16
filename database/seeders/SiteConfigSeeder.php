<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_path = 'data/site.json';
        $current_path = 'config/site.json';

        if (\Storage::exists($default_path)) {
            if (!\Storage::exists($current_path)) {
                \Storage::copy($default_path, $current_path);
            }
        }
    }
}
