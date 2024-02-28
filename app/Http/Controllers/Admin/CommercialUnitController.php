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

    public function get_all() {
        $records = CommercialUnit::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new CommercialUnit;
        $record->retail_id = $request->retail_id;
        $record->building = $request->building;
        $record->size = $request->size;
        $record->save();

        return response(['msg' => 'Added Commercial Unit']);
    }

    public function edit(Request $request) {
        $record = CommercialUnit::find($request->upd_id);
        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = CommercialUnit::find($request->upd_id);

        $record->update([
            'retail_id' => $request->retail_id,
            'building' => $request->building,
            'size' => $request->size,
        ]);

        return response(['msg' => 'Updated Commercial Unit']);
    }

    public function delete(Request $request) {
        $record = CommercialUnit::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Commercial Unit']);
    }
}
