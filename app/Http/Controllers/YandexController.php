<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

    public function test()
    {
        $to = 'test-3k0qkxiov@srv1.mail-tester.com';

        try {
            Mail::to($to)->send(new TestMail());
            return 'Send successfully!';
        } catch (\Exception $e) {
            return 'Помилка при надсиланні: ' . $e->getMessage();
        }
    }
}
