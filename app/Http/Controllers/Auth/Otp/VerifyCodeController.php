<?php

namespace App\Http\Controllers\Auth\Otp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\VerifyCodeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SadiqSalau\LaravelOtp\Facades\Otp;

class VerifyCodeController extends Controller
{
    public function __invoke(VerifyCodeRequest $request)
    {
        $otp = Otp::identifier($request->validated('phone'))
            ->attempt($request->validated('code'));

        if ($otp['status'] == Otp::OTP_PROCESSED)
            return redirect($otp['result']['redirect_url'] ?? '/');

        return Response::json([
            'status' => $otp['status'],
            'message' => __($otp['status'])
        ]);
    }
}
