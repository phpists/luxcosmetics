<?php

use App\Services\Admin\PermissionService;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (PermissionService::getAll() as $category_title => $category_permissions) {
            foreach ($category_permissions as $name => $title) {
                Permission::create(['name' => $name]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
