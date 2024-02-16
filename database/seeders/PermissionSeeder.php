<?php

namespace Database\Seeders;

use App\Services\Admin\PermissionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionService::getAll() as $category_title => $category_permissions) {
            foreach ($category_permissions as $name => $title) {
                if (!Permission::whereName($name)->exists())
                    Permission::create(['name' => $name]);
            }
        }
    }
}
