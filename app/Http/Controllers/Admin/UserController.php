<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $query = User::customers();
        $info = Address::all();

        if ($request->id) {
            $query->where('id', $request->id);
        }

        if ($request->email) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->surname) {
            $query->where('surname', 'LIKE', '%' . $request->surname . '%');
        }

        if ($request->phone) {
            $query->where('phone', 'LIKE', '%' . $request->phone . '%');
        }
        if ($request->address) {
            $info->where('address', 'LIKE', '%' . $request->address . '%');
        }
        if ($request->region) {
            $info->where('region', 'LIKE', '%' . $request->region . '%');
        }
        if ($request->city) {
            $info->where('city', 'LIKE', '%' . $request->city . '%');
        }

        if ($request->created_at) {
            $query->where('created_at', $request->created_at);
        }

        $users = $query->paginate(15);


        if ($request->ajax()) {
            $productsHtml = view('admin.users.parts.table', ['users' => $users])->render();
            $paginateHtml = view('admin.users.parts.paginate', ['users' => $users])->render();

            return response()->json([
                'usersHtml' => $productsHtml,
                'paginateHtml' => $paginateHtml,
            ]);
        }

        return view('admin.users.index', compact('users', 'info'));
    }

    public function show(Request $request, $id)
    {
        $this->authorize('view', User::class);

        $user = User::find($id);

        if ($request->wantsJson())
            return $request->has('with_address')
                ? $user->load('defaultAddress')
                : $user;

        if (!$user) {
            abort(404);
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('update', User::class);

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->authorize('update', User::class);

        $user = User::find($request->id);
        if ($user) {
            $user->name = $request->name;
            $user->is_active = ($request->is_active !== null);
            $user->surname = $request->surname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->points = $request->points;
            $user->update();
        }

        return redirect()->route('admin.user.show', ['id' => $request->id])->with('success', 'Дані успішно оновлені');
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', User::class);

        User::query()->where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Пользователь успешно удален');
    }

    public function generate_password(Request $request) {
        $this->authorize('update', User::class);

        $user = User::query()->find($request->id);
        if (!$user) {
            abort(404);
        }
        $password = Str::password(length: 8);
        $user->update([
            'password' => Hash::make($password)
        ]);
        try {
            Mail::to($user->email)->send(new ResetPassword($password, $user->name));
        } catch (\Exception $exception){
            return redirect()->back()->with('error', 'Ошибка отправки письма с паролем, повторите еще раз либо обратитесь к разроботчику');
        }
        return redirect()->back()->with('success', 'Пароль успешно оновлен');
    }
}
