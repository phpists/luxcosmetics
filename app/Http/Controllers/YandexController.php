<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $data['apikey'] = env('YANDEX_SUGGEST_API_KEY');

        $result = Http::withQueryParameters($data)->get('https://suggest-maps.yandex.ru/v1/suggest');
        return Response::json($result->json(), $result->status());
    }

    public function test(Request $request)
    {
        $user = User::where('email', 'ab@2plus2.site')->first();

        if ($user) {
            Auth::login($user);
            return 'User authorized: ' . $user->name;
        }

        return 'User not found.';
    }
}
