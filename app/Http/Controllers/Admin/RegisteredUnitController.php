<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RegisteredUnit;
use App\Models\ResidentialUnit;

class RegisteredUnitController extends Controller
{
    public function index() {
        return view('admin.registered_units.index');
    }

    public function get_all() {
        $records = ResidentialUnit::join('registered_units', 'residential_units.id', '=', 'registered_units.residential_unit_id')->get();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function get_related() {
        $records = ResidentialUnit::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'name'=>'required',
            'picture'=>'required|image',
            'email'=>'required|email',
            'phone'=>'required',
            'residential_unit_id'=>'required',
        ]);

        $record = new RegisteredUnit;
        if($request->hasFile('picture')) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/registered_units/id_pics';
            $file->move($destination, $filename);

            $record->picture = $filename;
        }
        $record->name = $request->name;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->residential_unit_id = $request->residential_unit_id;
        $record->save();

        return response(['msg' => 'Added Registered Unit']);
    }

    public function edit(Request $request) {
        $record = ResidentialUnit::join('registered_units', 'residential_units.id', '=', 'registered_units.residential_unit_id')->where('registered_units.id', $request->upd_id)->get();
        $record = $record[0];
        $records = ResidentialUnit::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'residential_unit_id'=>'required',
        ]);

        $record = RegisteredUnit::find($request->upd_id);
        if($request->hasFile('picture')) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/registered_units/id_pics';
            $file->move($destination, $filename);

            $record->update([
                'name' => $request->name,
                'picture' => $filename,
                'email' => $request->email,
                'phone' => $request->phone,
                'residential_unit_id' => $request->residential_unit_id,
            ]);
        }
        else {
            $record->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'residential_unit_id' => $request->residential_unit_id,
            ]);
        }

        $record = ResidentialUnit::find($request->residential_unit_id);
        $record->update([
            'published' => $request->published,
        ]);

        return response(['msg' => 'Updated Registered Unit']);
    }

    public function delete(Request $request) {
        $record = RegisteredUnit::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Registered Unit']);
    }
}
