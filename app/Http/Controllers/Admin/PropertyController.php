<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index() {        
        return view('admin.properties.index');
    }

    public function get_all() {
        $records = Property::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }
    public function create(Request $request) {
        $request->validate([
            'logo'=>'required|image',
            'name'=>'required',
            'location'=>'required',
            'description'=>'required',
            'sale_status'=>'required',
        ]);

        $record = new Property;

        if( $request->hasFile('logo') ) {
            $file = $request->logo;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/properties/logos';
            $file->move( $destination, $filename );
        }

        $record->logo = $filename;
        $record->name = $request->name;
        $record->location = $request->location;
        $record->description = $request->description;
        $record->sale_status = $request->sale_status;
        $record->save();

        return response(['msg' => 'Added Property']);
    }

    public function edit(Request $request) {
        $record = Property::find($request->upd_id);
        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'logo'=>'image',
            'name'=>'required',
            'location'=>'required',
            'description'=>'required',
            'sale_status'=>'required',
        ]);

        $record = Property::find($request->upd_id);

        if( $request->hasFile( 'logo' ) ) {
            $file = $request->file('logo');
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/properties/logos';
            $file->move($destination, $filename );

            $record->update([
                'logo' => $filename,
                'name' => $request->name,
                'location' => $request->location,
                'description' => $request->description,
                'sale_status' => $request->sale_status,
            ]);    
        }
        else {
            $record->update([
                'name' => $request->name,
                'location' => $request->location,
                'description' => $request->description,
                'sale_status' => $request->sale_status,
            ]);  
        }

        return response(['msg' => 'Updated Property']);
    }

    public function delete(Request $request) {
        $record = Property::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Property']);
    }
}
