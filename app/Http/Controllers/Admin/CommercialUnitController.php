<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CommercialUnit;
use App\Models\Property;

class CommercialUnitController extends Controller
{
    public function index() {
        return view('admin.commercial_units.index');
    }

    public function get_all() {
        $records = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->get();
        
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
        $record = new CommercialUnit;
        $record->retail_id = $request->retail_id;
        $record->building = $request->building;
        $record->size = $request->size;
        $record->property_id = $request->property_id;
        $record->save();

        return response(['msg' => 'Added Commercial Unit']);
    }

    public function edit(Request $request) {
        $record = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where('commercial_units.id', $request->upd_id)->get();
        $record = $record[0];
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = CommercialUnit::find($request->upd_id);

        $record->update([
            'retail_id' => $request->retail_id,
            'building' => $request->building,
            'size' => $request->size,
            'property_id' => $request->property_id,
        ]);

        return response(['msg' => 'Updated Commercial Unit']);
    }

    public function delete(Request $request) {
        $record = CommercialUnit::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Commercial Unit']);
    }
}
