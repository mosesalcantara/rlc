<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Picture;
use App\Models\Property;

class PictureController extends Controller
{
    public function index() {
        return view('admin.pictures.index');
    }

    public function get_all() {
        $records = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->get();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function get_related() {
        $records = Property::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        if( $request->hasFile('picture') ) {
            foreach ($request->picture as $file) {
                $filename = mt_rand() . '.'.$file->clientExtension();
                $destination = 'uploads/properties/pictures';
                $file->move($destination, $filename);

                $record = new Picture;
                $record->picture = $filename;
                $record->property_id = $request->property_id;
                $record->save();
            }
        }

        return response(['msg' => 'Added Pictures']);
    }

    public function edit(Request $request) {
        $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->where('pictures.id', $request->upd_id)->get();
        $record = $record[0];
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Picture::find($request->upd_id);
        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/properties/pictures';
            $file->move($destination, $filename);

            $record->update([
                'picture' => $filename,
                'property_id' => $request->property_id,
            ]);
        }
        else {
            $record->update([
                'property_id' => $request->property_id,
            ]);
        }

        return response(['msg' => 'Updated Picture']);
    }

    public function delete(Request $request) {
        $record = Picture::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Picture']);
    }
}
