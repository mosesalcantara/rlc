<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

use App\Models\ResidentialUnit;
use App\Models\Property;

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
        $records = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();
        
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
        $record = new ResidentialUnit;
        $record->unit_id = $request->unit_id;
        $record->building = $request->building;
        $record->type = $request->type;
        $record->area = $request->area;
        $record->rate = $request->rate;
        $record->status = $request->status;
        $record->property_id = $request->property_id;
        $record->save();

        return response(['msg' => 'Added Residential Unit']);
    }

    public function edit(Request $request) {
        $record = Property::leftJoin('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('residential_units.id', $request->upd_id)->get();
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $r_unit = ResidentialUnit::find($request->upd_id);

        $r_unit->update([
            'unit_id' => $request->unit_id,
            'building' => $request->building,
            'type' => $request->type,
            'area' => $request->area,
            'rate' => $request->rate,
            'status' => $request->status,
            'property_id' => $request->property_id,
        ]);

        return redirect('/admin/residential');
    }


    public function delete(Request $request) {
        $record = ResidentialUnit::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Residential Unit']);
    }
}
