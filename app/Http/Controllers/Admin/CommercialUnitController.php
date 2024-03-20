<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CommercialUnit;
use App\Models\Property;
use App\Models\Building;

class CommercialUnitController extends Controller
{
    public function index() {
        return view('admin.commercial_units.index');
    }

    public function get_all() {
        $records = Property::select('commercial_units.id', 'retail_id', 'size', 'building_id', 'properties.name as property', 'properties.location as location')
                    ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->get();

        foreach ($records as $c_unit) {
            $record = Building::where('id', $c_unit['building_id'])->get();
            $c_unit['building'] = $record[0]['name'];
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
            'retail_id'=>'required',
            'building_id'=>'required',
            'size'=>'required|numeric',
        ]);

        $record = new CommercialUnit;
        $record->retail_id = $request->retail_id;
        $record->size = $request->size;
        $record->property_id = $request->property_id;
        $record->building_id = $request->building_id;
        $record->save();

        return response(['msg' => 'Added Commercial Unit']);
    }

    public function edit(Request $request) {
        $record = Property::select('commercial_units.id', 'retail_id', 'size', 'building_id', 'property_id', 'properties.name as property', 'properties.location as location')
                    ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')
                    ->where('commercial_units.id', $request->upd_id)->get();
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
            'retail_id'=>'required',
            'building_id'=>'required',
            'size'=>'required|numeric',
        ]);
        
        $record = CommercialUnit::find($request->upd_id);

        $record->update([
            'retail_id' => $request->retail_id,
            'size' => $request->size,
            'property_id' => $request->property_id,
            'building_id' => $request->building_id,
        ]);

        return response(['msg' => 'Updated Commercial Unit']);
    }

    public function delete(Request $request) {
        $record = CommercialUnit::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Commercial Unit']);
    }
}
