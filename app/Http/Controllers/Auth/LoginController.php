<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\FavoriteProductsService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

        $socialiteUser = Socialite::driver($provider)->user();

        switch ($provider) {
            case 'google':
                $data['name'] = $socialiteUser->user['given_name'];
                $data['surname'] = $socialiteUser->user['family_name'];
                $data['email'] = $socialiteUser->user['email'];
                break;
            case 'facebook':
                $data['name'] = $socialiteUser->user['name'];
                $data['surname'] = '';
                $data['email'] = array_key_exists('email', $socialiteUser->user)?$socialiteUser->user['email']:'';
                $data['phone'] = array_key_exists('phone', $socialiteUser->user)?$socialiteUser->user['phone']:'';
                break;
        }

        $user = User::whereEmail($data['email'])->first();
//        $user->updateLastActive();

        if (!$user) {
            $data['password'] = Str::random(8);

            $user = User::create([
                'role_id' => User::USER,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            Auth::loginUsingId($user->id);

            try {
                FavoriteProductsService::migrateIntoDb($user->id);
            }
            catch (\Error $error) {
                Log::error($error->getMessage());
            }

            return redirect('/profile');
        } else {
//            $check = $user->checkUserStatus();
//            if ($check['status']) {
//                return redirect()->route('login', app()->getLocale())->with('error_user_status', $check['msg']);
//            }


            Auth::loginUsingId($user->id);

            if (Str::contains(url()->previous(), '/cart/login')) {
                return redirect()->to(route('cart.delivery'));
            } else {
                return redirect('/profile');
            }
        }
    }

    public function authenticated(Request $request, $user)
    {
        $previous = url()->previous();

        if ($user->role_id == User::ADMIN && str_contains($previous, '/admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Str::contains($previous, '/cart/login')) {
            return redirect()->to(route('cart.delivery'));
        } else {
            return redirect()->to(route('profile'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
