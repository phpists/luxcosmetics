<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Auth::logout();
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        $previous = url()->previous();

        if ($user->role_id == User::ADMIN && str_contains($previous, '/admin')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->to($previous);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
