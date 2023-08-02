<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Services\FileService;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{

    public function index(Request $request)
    {
        $networks = SocialMedia::network()->orderBy('pos')->get();
        $network_next_pos = SocialMedia::network()->max('pos');
        $network_next_pos = $network_next_pos ? $network_next_pos + 1 : 1;

        $messengers = SocialMedia::messenger()->orderBy('pos')->get();
        $messenger_next_pos = SocialMedia::messenger()->max('pos');
        $messenger_next_pos = $messenger_next_pos ? $messenger_next_pos + 1 : 1;

        $phone = SocialMedia::all();

        return view('admin.settings.socials.index', compact('networks', 'network_next_pos',
            'messengers', 'messenger_next_pos', 'phone'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active_in_contacts'] = $request->post('is_active_in_contacts') ? 1 : 0;
        $data['is_active_in_footer'] = $request->post('is_active_in_footer') ? 1 : 0;

        $data['icon'] = FileService::saveFile('uploads', "social", $request->icon);

        $social = SocialMedia::create($data);

        if ($social) {
            return redirect()->back()->with('success', ($data['type_id'] == SocialMedia::TYPE_NETWORK ? 'Соц.мережу' : 'Месенджер') . ' успішно додано');
        } else {
            return redirect()->back()->with('error', 'Не вдалось додати ' .  ($data['type_id'] == SocialMedia::TYPE_NETWORK ? 'соц.мережу' : 'месенджер'));
        }
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $social = SocialMedia::findOrFail($id);
        return response()->json($social);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $data['is_active_in_contacts'] = $request->post('is_active_in_contacts') == 'on' ? 1 : 0;
        $data['is_active_in_footer'] = $request->post('is_active_in_footer') == 'on' ? 1 : 0;
        // dd($request->post('is_active_in_contacts'));

        $social = SocialMedia::findOrFail($data['id']);

        if ($request->hasFile('icon')) {
            $icon = FileService::saveFile('uploads', "social", $request->icon);
            $social->icon = $icon;
            $social->update(['icon' => $icon]);
        }else{
            $social->update($data);
        }


        if ($social->update($data)) {
            return redirect()->back()->with('success', ($social->type_id == SocialMedia::TYPE_NETWORK ? 'Соц.мережу' : 'Месенджер') . ' успішно відредаговано');
        } else {
            return redirect()->back()->with('error', 'Не вдалось відредагувати ' .  ($social->type_id == SocialMedia::TYPE_NETWORK ? 'соц.мережу' : 'месенджер'));
        }
    }
    public function updatePhone(Request $request)
    {
        $phone = $request->input('phone');
        $social = SocialMedia::first();

    if ($social == null) {
        $phone->save();
    } else {
        $social->phone = $phone;
        $social->save();
    }

    return redirect()->route('admin.settings.socials');
    }

    public function change_status(Request $request)
    {
        $id = $request->post('id');
        $type = $request->post('type');
        $status = $request->post('status') ? 1 : 0;

        $social = SocialMedia::find($id);
        if ($type == 'contacts') {
            $social->is_active_in_contacts = $status;
        } elseif ($type == 'footer') {
            $social->is_active_in_footer = $status;
        }

        return $social->save();
    }

    public function updates_positions(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $social = SocialMedia::findOrFail($position['id']);
                $social->pos = $position['pos'];
                $social->save();
            }
        }
    }

    public function destroy(Request $request)
    {
        $social = SocialMedia::findOrFail($request->post('id'));
        $social->delete();

        return redirect()->back()->with('success', 'Запис про соціальну медіа видалено');
    }
}
