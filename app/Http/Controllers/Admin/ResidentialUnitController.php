<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

use App\Models\ResidentialUnit;
use App\Models\Property;
use App\Models\Building;

class ResidentialUnitController extends Controller
{

    public function test() {        
        $r_unit = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('residential_units.id', 4)->get();
        
        return view('admin.residential_units.test')->with('r_unit', $r_unit);
    }

    public function index() {
        return view('admin.residential_units.index');
    }

    public function get_all() {
        $records = Property::select('residential_units.id', 'unit_id', 'type', 'area', 'rate', 'status', 'building_id', 'properties.name as property', 'properties.location as location')
                    ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();
        
        foreach ($records as $r_unit) {
            $record = Building::where('id', $r_unit['building_id'])->get();
            $r_unit['building'] = $record[0]['name'];
        }

        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function related_properties() {
        $records = Property::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function related_buildings(Request $request) {
        $records = Property::join('buildings', 'properties.id', '=', 'buildings.property_id')->where('properties.id', $request->property_id)->get();

        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'property_id'=>'required',
            'unit_id'=>'required',
            'building_id'=>'required',
            'type'=>'required',
            'area'=>'required|numeric',
            'rate'=>'required|numeric',
            'status'=>'required',
        ]);

        $record = new ResidentialUnit;
        $record->unit_id = $request->unit_id;
        $record->type = $request->type;
        $record->area = $request->area;
        $record->rate = $request->rate;
        $record->status = $request->status;
        $record->property_id = $request->property_id;
        $record->building_id = $request->building_id;
        $record->save();

        return response(['msg' => 'Added Residential Unit']);
    }

    public function edit(Request $request) {
        $record = Property::select('residential_units.id', 'unit_id', 'type', 'area', 'rate', 'status', 'building_id', 'property_id', 'properties.name as property', 'properties.location as location')
                    ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')
                    ->where('residential_units.id', $request->upd_id)->get();
        $record = $record[0];

        $building = Building::where('id', $record['building_id'])->get();
        $record['building'] = $building[0]['name'];

        $properties = Property::all();
        $buildings = Property::join('buildings', 'properties.id', '=', 'buildings.property_id')->where('properties.id', $record['property_id'])->get();

        $data = [
            'record' => $record,
            'properties' => $properties,
            'buildings' => $buildings,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'property_id'=>'required',
            'unit_id'=>'required',
            'building_id'=>'required',
            'type'=>'required',
            'area'=>'required|numeric',
            'rate'=>'required|numeric',
            'status'=>'required',
        ]);
        
        $record = ResidentialUnit::find($request->upd_id);

        $record->update([
            'unit_id' => $request->unit_id,
            'type' => $request->type,
            'area' => $request->area,
            'rate' => $request->rate,
            'status' => $request->status,
            'property_id' => $request->property_id,
            'building_id' => $request->building_id,
        ]);

        return response(['msg' => 'Updated Residential Unit']);
    }


    public function delete(Request $request) {
        $record = ResidentialUnit::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Residential Unit']);
    }
}
