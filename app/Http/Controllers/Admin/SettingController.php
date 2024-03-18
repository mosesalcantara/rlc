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

    public function get_all() {
        $records = Setting::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new Setting;

        if( $request->hasFile('logo') ) {
            $file = $request->logo;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/settings/logos';
            $file->move( $destination, $filename );
        }

        $record->logo = $filename;
        $record->office = $request->office;
        $record->address = $request->address;
        $record->email = $request->email;
        $record->telephone = $request->telephone;
        $record->mobile = $request->mobile;
        $record->facebook = $request->facebook;
        $record->twitter = $request->twitter;
        $record->instagram = $request->instagram;
        $record->youtube = $request->youtube;
        $record->save();

        return response(['msg' => 'Added Setting']);
    }

    public function edit(Request $request) {
        $record = Setting::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Setting::find($request->upd_id);

        if( $request->hasFile('logo') ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/settings/logos';
            $file->move($destination, $filename );

            $record->update([
                'logo' => $filename,
                'office' => $request->office,
                'address' => $request->address,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
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
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
            ]);
        }

        return response(['msg' => 'Updated Setting']);
    }

    public function delete(Request $request) {
        $record = Setting::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Setting']);
    }
}
