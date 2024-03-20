<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ParkingSlot;
use App\Models\Property;

class ParkingSlotController extends Controller
{
    public function index() {        
        return view('admin.parking_slots.index');
    }

    public function get_all() {
        $records = Property::join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->get();
        
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
        $request->validate([
            'property_id'=>'required',
            'floor'=>'required',
            'slot'=>'required',
            'rate'=>'required|numeric',
        ]);

        $record = new ParkingSlot;

        $record->floor = $request->floor;
        $record->slot = $request->slot;
        $record->rate = $request->rate;
        $record->property_id = $request->property_id;
        $record->save();

        return response(['msg' => 'Added Parking Slot']);
    }

    public function edit(Request $request) {
        $record = Property::join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where('parking_slots.id', $request->upd_id)->get();
        $record = $record[0];
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'property_id'=>'required',
            'floor'=>'required',
            'slot'=>'required',
            'rate'=>'required|numeric',
        ]);
        
        $record = ParkingSlot::find($request->upd_id);

        $record->update([
            'floor' => $request->floor,
            'slot' => $request->slot,
            'rate' => $request->rate,
            'property_id' => $request->property_id,
        ]);

        return response(['msg' => 'Updated Parking Slot']);
    }

    public function delete(Request $request) {
        $record = ParkingSlot::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Parking Slot']);
    }
}
