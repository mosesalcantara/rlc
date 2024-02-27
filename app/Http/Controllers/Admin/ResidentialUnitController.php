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
        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();


        return view('admin.residential_units.index')->with('r_units', $r_units);
    }

    public function add() {
        $properties = Property::all();

        return view('admin.residential_units.add')->with('properties', $properties);
    }

    public function create(Request $request) {
        $r_unit = new ResidentialUnit;
        $r_unit->unit_id = $request->unit_id;
        $r_unit->building = $request->building;
        $r_unit->type = $request->type;
        $r_unit->area = $request->area;
        $r_unit->rate = $request->rate;
        $r_unit->status = $request->status;
        $r_unit->property_id = $request->property_id;
        $r_unit->save();

        return redirect('/admin/residential');
    }

    public function edit(Request $request) {
        $r_unit = Property::leftJoin('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('residential_units.id', $request->id)->get();
        $properties = Property::all();

        $data = [
            'r_unit' => $r_unit,
            'properties' => $properties,
        ];

        return view('admin.residential_units.edit')->with("data", $data);
    }

    public function update(Request $request) {
        $r_unit = ResidentialUnit::find($request->id);

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
        $r_unit = ResidentialUnit::find($request->id);
        $r_unit->delete();
        
        return redirect('/admin/residential');
    }
}
