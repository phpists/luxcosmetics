<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{

    public function index()
    {
        $networks = SocialMedia::network()->orderBy('pos')->get();
        $network_next_pos = SocialMedia::network()->max('pos');
        $network_next_pos = $network_next_pos ? $network_next_pos + 1 : 1;

        $messengers = SocialMedia::messenger()->orderBy('pos')->get();
        $messenger_next_pos = SocialMedia::messenger()->max('pos');
        $messenger_next_pos = $messenger_next_pos ? $messenger_next_pos + 1 : 1;

        $phone = Phone::all();

        return view('admin.settings.socials.index', compact('networks', 'network_next_pos',
            'messengers', 'messenger_next_pos', 'phone'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active_in_contacts'] = $request->post('is_active_in_contacts') ? 1 : 0;
        $data['is_active_in_footer'] = $request->post('is_active_in_footer') ? 1 : 0;

        Storage::disk('public')->putFile(
            'uploads/social',
            $request->file('icon'));
        $data['icon'] = $request->file('icon')->hashName();

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
        $data['is_active_in_contacts'] = $request->post('is_active_in_contacts') ? 1 : 0;
        $data['is_active_in_footer'] = $request->post('is_active_in_footer') ? 1 : 0;

        $social = SocialMedia::findOrFail($data['id']);
        

        if ($request->hasFile('icon')) {
            $social->dropIcon();
            Storage::disk('public')->putFile(
                'uploads/social',
                $request->file('icon'));
            $data['icon'] = $request->file('icon')->hashName();
        }


        if ($social->update($data)) {
            return redirect()->back()->with('success', ($social->type_id == SocialMedia::TYPE_NETWORK ? 'Соц.мережу' : 'Месенджер') . ' успішно відредаговано');
        } else {
            return redirect()->back()->with('error', 'Не вдалось відредагувати ' .  ($social->type_id == SocialMedia::TYPE_NETWORK ? 'соц.мережу' : 'месенджер'));
        }
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
