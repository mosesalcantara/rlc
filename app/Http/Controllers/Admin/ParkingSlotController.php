<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingSlot;

class ParkingSlotController extends Controller
{
    public function index() {        
        return view('admin.parking_slots.index');
    }

    public function get_all() {
        $records = ParkingSlot::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new ParkingSlot;
        $record->rate = $request->rate;
        $record->save();

        return response(['msg' => 'Added Parking Slot']);
    }

    public function edit(Request $request) {
        $record = ParkingSlot::find($request->upd_id);
        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = ParkingSlot::find($request->upd_id);

        $record->update([
            'rate' => $request->rate,
        ]);

        return response(['msg' => 'Updated Parking Slot']);
    }

    public function delete(Request $request) {
        $record = ParkingSlot::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Parking Slot']);
    }
}
