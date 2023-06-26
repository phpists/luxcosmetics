<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
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
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->update();
        }

        return redirect()->route('admin.user.show', ['id' => $request->id])->with('success', 'Дані успішно оновлені');
    }
}
