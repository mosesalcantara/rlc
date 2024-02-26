<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommercialUnit;

class CommercialUnitController extends Controller
{
    public function index() {
        $c_units = CommercialUnit::all();
        
        return view('admin.commercial_units.index')->with('c_units', $c_units);
    }

    public function add() {
        return view('admin.commercial_units.add');
    }

    public function create(Request $request) {
        $c_unit = new CommercialUnit;
        $c_unit->retail_id = $request->retail_id;
        $c_unit->building = $request->building;
        $c_unit->size = $request->size;
        $c_unit->save();

        return redirect('/admin/commercial');
    }

    public function edit(Request $request) {
        $c_unit = CommercialUnit::find($request->id);
        return view('admin.commercial_units.edit')->with("c_unit", $c_unit);
    }

    public function update(Request $request) {
        $c_unit = CommercialUnit::find($request->id);

        $c_unit->update([
            'retail_id' => $request->retail_id,
            'building' => $request->building,
            'size' => $request->size,
        ]);

        return redirect('/admin/commercial');
    }

    public function delete(Request $request) {
        $c_unit = CommercialUnit::find($request->id);
        $c_unit->delete();
        
        return redirect('/admin/commercial');
    }
}
