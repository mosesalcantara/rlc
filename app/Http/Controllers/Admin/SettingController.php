<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    public function index() {
        return view('admin.settings.index');
    }

    public function edit() {
        $record = Setting::first();

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'logo'=>'image',
            'office'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'telephone'=>'required',
            'mobile'=>'required',
            'messenger'=>'required|url',
            'messenger_text'=>'required',
            'telegram'=>'required|url',
            'telegram_text'=>'required',
            'wechat'=>'required|url',
            'wechat_text'=>'required',
            'viber'=>'required|url',
            'viber_text'=>'required',
            'facebook'=>'required|url',
            'twitter'=>'required|url',
            'instagram'=>'required|url',
            'youtube'=>'required|url',
        ]);

        $record = Setting::find($request->upd_id);

        if( $request->hasFile('logo') ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/settings/logos';
            $file->move($destination, $filename );

            $record->update([
                'logo' => $filename,
                'office' => $request->office,
                'address' => $request->address,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'messenger' => $request->messenger,
                'messenger_text' => $request->messenger_text,
                'telegram' => $request->telegram,
                'telegram_text' => $request->telegram_text,
                'wechat' => $request->wechat,
                'wechat_text' => $request->wechat_text,
                'viber' => $request->viber,
                'viber_text' => $request->viber_text,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
            ]);
        }
        else {
            $record->update([
                'office' => $request->office,
                'address' => $request->address,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'messenger' => $request->messenger,
                'messenger_text' => $request->messenger_text,
                'telegram' => $request->telegram,
                'telegram_text' => $request->telegram_text,
                'wechat' => $request->wechat,
                'wechat_text' => $request->wechat_text,
                'viber' => $request->viber,
                'viber_text' => $request->viber_text,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
            ]);
        }

        return response(['msg' => 'Updated Settings']);
    }
}
