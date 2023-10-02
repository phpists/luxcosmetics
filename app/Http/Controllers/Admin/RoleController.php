<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
            'permissions' => PermissionService::getAll()
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->post('name');
        $role_permissions = $request->post('permissions', []);

        try {
            DB::beginTransaction();

            $permissions = Permission::whereIn('name', $role_permissions)->get();
            $role = Role::create(['name' => $name]);
            $role->syncPermissions($permissions);

            DB::commit();
            return back()->with('success', 'Роль добавлена');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors("ОШИБКА: {$exception->getMessage()}");
        }
    }

    public function show(Request $request, Role $role)
    {
        if ($request->wantsJson())
            return $role->load('permissions');
    }

    public function update(Request $request, Role $role)
    {
        $name = $request->post('name');
        $role_permissions = $request->post('permissions', []);

        try {
            DB::beginTransaction();

            $permissions = Permission::whereIn('name', $role_permissions)->get();
            $role->update(['name' => $name]);
            $role->syncPermissions($permissions);

            DB::commit();
            return back()->with('success', 'Роль добавлена');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors("ОШИБКА: {$exception->getMessage()}");
        }
    }

    public function destroy(Request $request, Role $role)
    {
        if ($role->delete())
            return back()->with('success', 'Роль успешно удалена');

        return back()->withErrors('ОШИБКА: Не удалось удалить роль!');
    }

}
