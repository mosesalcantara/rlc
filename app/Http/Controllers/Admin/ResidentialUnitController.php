<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\ResidentialUnit;

class ResidentialUnitController extends Controller
{


    public function index() {
        $r_units = ResidentialUnit::all();
        
        return view('admin.residential_units.index')->with('r_units', $r_units);
    }

    public function add() {
        return view('admin.residential_units.add');
    }

    public function create(Request $request) {
        $r_unit = new ResidentialUnit;
        $r_unit->unit_id = $request->unit_id;
        $r_unit->building = $request->building;
        $r_unit->type = $request->type;
        $r_unit->area = $request->area;
        $r_unit->rate = $request->rate;
        $r_unit->status = $request->status;
        $r_unit->save();

        return redirect('/admin/residential');
    }

    public function edit(Request $request) {
        $r_unit = ResidentialUnit::find($request->id);
        return view('admin.residential_units.edit')->with("r_unit", $r_unit);
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
        ]);

        return redirect('/admin/residential');
    }


    public function delete(Request $request) {
        $r_unit = ResidentialUnit::find($request->id);
        $r_unit->delete();
        
        return redirect('/admin/residential');
    }
}
