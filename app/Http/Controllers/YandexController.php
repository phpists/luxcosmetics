<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class YandexController extends Controller
{
    public function suggest(Request $request)
    {
        $data = $request->validate([
            'types' => ['string', 'required'],
            'text' => ['string', 'required'],
            'print_address' => ['int', 'required'],
        ]);
        $data['apikey'] = env('YANDEX_SUGGEST_API_KEY', '441999c3-4640-4dda-8b15-0e58dfa907d0');

        $result = Http::withQueryParameters($data)->get('https://suggest-maps.yandex.ru/v1/suggest');
        return Response::json($result->json(), $result->status());
    }
}
