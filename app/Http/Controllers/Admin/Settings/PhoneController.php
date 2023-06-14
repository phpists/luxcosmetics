<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function edit()
    {
        $data = Phone::all();
        dd($data);
        $phone = Phone::findOrFail($number);
        return view('admin.settings.telephone.update', compact('phone'));
    }

    public function update(Request $request, $number)
    {
        $data = $request->link;

        $phone = Phone::where('number', $number)->first();
        if ($phone !== $data) {
           $phone->update(['number' => $data]);
        }
    
        return redirect()->route('admin.settings.socials');
   
    }
    
}
