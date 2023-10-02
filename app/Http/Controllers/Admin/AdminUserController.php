<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.admin-users.index', [
            'users' => User::admins()->paginate(),
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'unique:users,email'
        ]);

        $data = $request->post();
        $data['is_active'] = $request->boolean('is_active');
        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = User::ADMIN;

        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        try {
            $admin = User::create($data);
            $admin->syncRoles($roles);

            return back()->with('success', 'Администратор успешно сохранен');
        } catch (\Exception $exception) {
            return back()->with('error', "ОШИБКА: {$exception->getMessage()}");
        }
    }

    public function show(Request $request, User $admin)
    {
        if ($request->wantsJson())
            return $admin->load('roles');

        return back();
    }

    public function update(Request $request, User $admin)
    {
        $data = $request->post();
        $data['is_active'] = $request->boolean('is_active');
        if ($request->post('password'))
            $data['password'] = Hash::make($data['password']);
        else
            unset($data['password']);

        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        if ($admin->update($data)) {
            $admin->syncRoles($roles);
            return back()->with('success', 'Администратор успешно сохранен');
        }

        return back()->withErrors(['Ошибка! Не удалось сохранить изменения!']);
    }

    public function destroy(Request $request, User $admin)
    {
        if ($admin->delete())
            return back()->with('success', 'Администратор удален');
        else
            return back()->withErrors(['Не удалось удалить администратора!']);
    }

}
