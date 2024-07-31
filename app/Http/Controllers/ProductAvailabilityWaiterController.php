<?php

namespace App\Http\Controllers;

use App\Models\ProductAvailabilityWaiter;
use Illuminate\Http\Request;

class ProductAvailabilityWaiterController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'name' => ['required','string','max:255'],
            'email' => ['required','email'],
        ]);

        if (ProductAvailabilityWaiter::whereProductId($data['product_id'])->whereEmail($data['email'])->exists())
            return redirect()->back()->with('success', 'Вы уже подписаны на товар');

        if (\Auth::check())
            $data['user_id'] = \Auth::id();

        ProductAvailabilityWaiter::create($data);
        return redirect()->back()->with('success', 'Вы успешно подписались на товар. Как только он поступит в наличие - вы получите уведомление');
    }

}
