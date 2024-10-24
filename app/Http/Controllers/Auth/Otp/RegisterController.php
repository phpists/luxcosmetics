<?php

namespace App\Http\Controllers\Auth\Otp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\RegisterRequest;
use App\Otp\UserRegisterOtp;
use App\Services\Auth\OtpService;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    public function __construct(public readonly OtpService $otpService)
    {
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $phone = $request->validated('phone');
        $registerHandler = new UserRegisterOtp($request->validated());

        return Response::json($this->otpService->send($registerHandler, $phone));
    }
}
