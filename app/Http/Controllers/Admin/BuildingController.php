<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Building;
use App\Models\Property;

class BuildingController extends Controller
{
    public function index() {
        return view('admin.buildings.index');
    }

    public function get_all() {
        $records = Property::select('buildings.id', 'buildings.name', 'buildings.floor_plan', 'properties.name as property', )
                    ->join('buildings', 'properties.id', '=', 'buildings.property_id')->get();
        
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
        $record = new Building;

        if( $request->hasFile('floor_plan') ) {
            $file = $request->floor_plan;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/buildings/floor_plans';
            $file->move( $destination, $filename );
        }

        $record->name = $request->name;
        $record->floor_plan = $filename;
        $record->property_id = $request->property_id;
        $record->save();

        return response(['msg' => 'Added Building']);
    }

    public function edit(Request $request) {
        $record = Property::join('buildings', 'properties.id', '=', 'buildings.property_id')->where('buildings.id', $request->upd_id)->get();
        $record = $record[0];
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Building::find($request->upd_id);

        if( $request->hasFile('floor_plan') ) {
            $file = $request->floor_plan;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/buildings/floor_plans';
            $file->move($destination, $filename );

            $record->update([
                'name' => $request->name,
                'floor_plan' => $filename,
                'property_id' => $request->property_id,
            ]);
        }
        else {
            $record->update([
                'name' => $request->name,
                'property_id' => $request->property_id,
            ]);
        }

        return response(['msg' => 'Updated Building']);
    }


    public function delete(Request $request) {
        $record = Building::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Building']);
    }
}
