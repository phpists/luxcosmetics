<?php

namespace App\Http\Controllers\Auth\Otp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\CartLoginRequest;
use App\Otp\UserCartLoginOtp;
use App\Services\Auth\OtpService;
use Illuminate\Support\Facades\Response;

class CartLoginController extends Controller
{
    public function __construct(public readonly OtpService $otpService)
    {
    }

    public function __invoke(CartLoginRequest $request)
    {
        $phone = $request->validated('phone');
        $cartLoginHandler = new UserCartLoginOtp($request->validated());

        return Response::json($this->otpService->send($cartLoginHandler, $phone));
    }
}
