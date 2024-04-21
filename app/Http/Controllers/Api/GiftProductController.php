<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GiftProductImportRequest;
use App\Services\Api\GiftProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GiftProductController extends Controller
{

    public function __construct(private readonly GiftProductService $giftProductService)
    {
    }

    public function import(GiftProductImportRequest $request)
    {
        try {
            $this->giftProductService->import($request->validated());
            return new JsonResponse(['status' => 'success']);
        } catch (\Throwable $e) {
            \Log::error('API > gift-products > import: ' . $e->getMessage());
            return new JsonResponse([
                'status' => 'fail',
                'message' => 'ERROR'
            ], 500);
        }
    }

}
