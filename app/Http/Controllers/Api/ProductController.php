<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductsImportRequest;
use App\Http\Requests\Api\ProductsUpdateStocksRequest;
use App\Services\Api\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(public ProductService $productService)
    {
    }

    public function import(ProductsImportRequest $request)
    {
//        try {
            $this->productService->import($request);

            return new JsonResponse(['status' => 'success']);
//        } catch (\Exception $e) {
//            return new JsonResponse([
//                'status' => 'fail',
//                'message' => $e->getMessage()
//            ], 500);
//        }
    }

    public function updateStocks(ProductsUpdateStocksRequest $request)
    {
        try {
            $this->productService->updateStocks($request);

            return new JsonResponse(['status' => 'success']);
        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => 'fail',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
