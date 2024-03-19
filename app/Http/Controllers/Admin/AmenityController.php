<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Amenity;
use App\Models\Property;

class AmenityController extends Controller
{
    public function index() {
        return view('admin.amenities.index');
    }

    public function get_all() {
        $records = Property::select('amenities.id', 'amenities.name', 'amenities.type', 'amenities.picture', 'amenities.property_id', 'properties.name as property', )
                    ->join('amenities', 'properties.id', '=', 'amenities.property_id')->get();
        
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
        $record = new Amenity;

        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/pictures';
            $file->move($destination, $filename);
        }

        $record->name = $request->name;
        $record->type = $request->type;
        $record->picture = $filename;
        $record->property_id = $request->property_id;
        $record->save();

        return response(['msg' => 'Added Amenity']);
    }

    public function edit(Request $request) {
        $record = Property::join('amenities', 'properties.id', '=', 'amenities.property_id')->where('amenities.id', $request->upd_id)->get();
        $record = $record[0];
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Amenity::find($request->upd_id);

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/pictures';
            $file->move($destination, $filename );

            $record->update([
                'name' => $request->name,
                'type' => $request->type,
                'picture' => $filename,
                'property_id' => $request->property_id,
            ]);
        }
        else {
            $record->update([
                'name' => $request->name,
                'type' => $request->type,
                'property_id' => $request->property_id,
            ]);
        }

        return response(['msg' => 'Updated Amenity']);
    }

    public function delete(Request $request) {
        $record = Amenity::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Amenity']);
    }
}
