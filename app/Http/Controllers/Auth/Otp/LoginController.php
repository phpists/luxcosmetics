<?php

namespace App\Http\Controllers\Auth\Otp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\LoginRequest;
use App\Otp\UserLoginOtp;
use App\Services\Auth\OtpService;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function __construct(public readonly OtpService $otpService)
    {
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $phone = $request->validated('phone');
        $loginHandler = new UserLoginOtp($phone);

        return Response::json($this->otpService->send($loginHandler, $phone));
    }
}
