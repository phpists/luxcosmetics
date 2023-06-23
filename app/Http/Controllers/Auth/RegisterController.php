<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationConfirmation;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\FavoriteProductsService;
use App\Services\MailService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'required.name' => 'Поле Имя обязательное',
            'required.email' => 'Поле Почта обязательное',
            'required.password' => 'Поле Пароль обязательное',
            'password.min' => 'Минимальная длина пароля 8 символов',
            'password.max' => 'Максимальная длина пароля 255 символов',
            'email.max' => 'Максимальная длина почты 255 символов',
            'email.unique' => 'Почта :input уже занята',
            'name.max' => 'Максимальная длина имени 255 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $date = date_create_from_format('Y-m-d', $data['year'].'-'.$data['month'].'-'.$data['day']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'surname' => array_key_exists('surname', $data)?$data['surname']:null,
            'phone' => array_key_exists('phone', $data)?$data['phone']:null,
            'connection_type' => array_key_exists('connection_type', $data)?$data['connection_type']:null,
            'is_subscribed' => array_key_exists('newsletter', $data)?1:0,
            'birthday' => $date,
        ]);

        try {
            // Send email
            MailService::sendRegistrationMessage($user);
            // Write favourites products to db
            FavoriteProductsService::migrateIntoDb($user->id);
        }
        catch (\Exception $error) {
            Log::error($error->getMessage());
        }
        return $user;
    }
}
