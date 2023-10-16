<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{

    public function update(Request $request)
    {
//        $id = $request->post('id');
//        if ($id) {
//            $setting = Setting::findOrFail($id);
//        } else {
//            $name = $request->post('name');
//            $setting = Setting::findOrFail(['name' => $name]);
//        }
//
//        $value = $request->post('value');
//
//        $setting_lang = $setting->lang;
//        $setting_lang->value = $value;
        return response()->json();
    }

    public function clearCache()
    {
        Cache::flush();
        return redirect()->back()->with('success', 'Кеш успешно очищен.');
    }

}
