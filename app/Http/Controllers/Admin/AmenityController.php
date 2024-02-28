<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    public function index() {
        return view('admin.amenities.index');
    }

    public function get_all() {
        $records = Amenity::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function add() {
        return view('admin.amenities.add');
    }

    public function create(Request $request) {
        $amenity = new Amenity;

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/picture';
            $file->move($destination, $filename);
        }

        $amenity->name = $request->name;
        $amenity->type = $request->type;
        $amenity->picture = $filename;
        $amenity->save();

        return response(['msg' => 'Added Amenity']);
    }

    public function edit(Request $request) {
        $record = Amenity::find($request->upd_id);
        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $amenity = Amenity::find($request->upd_id);

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/picture';
            $file->move($destination, $filename );

            $amenity->update([
                'name' => $request->name,
                'type' => $request->type,
                'picture' => $filename,
            ]);
        }
        else {
            $amenity->update([
                'name' => $request->name,
                'type' => $request->type,
            ]);
        }

        return response(['msg' => 'Updated Amenity']);
    }

    public function delete(Request $request) {
        $amenity = Amenity::find($request->del_id);
        $amenity->delete();
        
        return response(['msg' => 'Deleted Amenity']);
    }
}
