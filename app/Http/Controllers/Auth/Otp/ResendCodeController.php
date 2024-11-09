<?php

namespace App\Http\Controllers\Auth\Otp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\ResendCodeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SadiqSalau\LaravelOtp\Facades\Otp;

class ResendCodeController extends Controller
{
    public function __invoke(ResendCodeRequest $request)
    {
        $otp = Otp::identifier($request->validated('phone'))->update();

        return Response::json([
            'status' => $otp['status'],
            'message' => __($otp['status'])
        ]);
    }
}
