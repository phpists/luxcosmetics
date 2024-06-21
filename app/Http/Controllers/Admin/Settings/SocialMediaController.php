<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        $phone = SocialMedia::phone()->get();

        return view('admin.settings.socials.index', compact('networks', 'network_next_pos',
            'messengers', 'messenger_next_pos', 'phone'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active_in_contacts'] = $request->post('is_active_in_contacts') ? 1 : 0;
        $data['is_active_in_footer'] = $request->post('is_active_in_footer') ? 1 : 0;

        $data['icon'] = FileService::saveFile('uploads', "social", $request->file('icon'));

        $social = SocialMedia::create($data);

        if ($social) {
            return redirect()->back()->with('success', 'Данные успешно сохранены');
        } else {
            return redirect()->back()->with('error', 'Не удалось сохранить данные');
        }
    }

    public function storeMessenger(Request $request)
    {
        $data = $request->all();
        $data['type_id'] = SocialMedia::TYPE_MESSENGER;
        $data['pos'] = SocialMedia::network()->count() + 1;
        $data['is_active_in_contacts'] = $request->boolean('is_active_in_contacts');
        $data['is_active_in_footer'] = $request->boolean('is_active_in_footer');

        $data['icon'] = FileService::saveFile('uploads', "social", $request->file('icon'));

        $social = SocialMedia::create($data);

        if ($social) {
            return redirect()->back()->with('success', 'Данные успешно сохранены');
        } else {
            return redirect()->back()->with('error', 'Не удалось сохранить данные');
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

        $social = SocialMedia::findOrFail($data['id']);

        if ($request->hasFile('icon')) {
            $icon = FileService::saveFile('uploads', "social", $request->file('icon'));
            $data['icon'] = $icon;
        }

        $social->update($data);

        return redirect()->back()->with('success', 'Данные успешно сохранены');
    }
    public function updatePhone(Request $request)
    {
        $phone = $request->input('phone');
        $social = SocialMedia::phone()->limit(1)->get();

        if ($social->isEmpty()) {
            SocialMedia::create([
                'type_id' => SocialMedia::TYPE_NUMBER,
                'phone' => $phone,
            ]);
        } else {
            $social->first()->update([
                'type_id' => SocialMedia::TYPE_NUMBER,
                'phone' => $phone,
            ]);
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
        } elseif ($type == 'header') {
            $social->is_active_in_header = $status;
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

        return redirect()->back()->with('success', 'Данные успешно удалены');
    }
}
