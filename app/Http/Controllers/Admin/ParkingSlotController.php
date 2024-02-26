<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingSlot;

class ParkingSlotController extends Controller
{
    public function index() {
        $p_slots = ParkingSlot::all();
        
        return view('admin.parking_slots.index')->with('p_slots', $p_slots);
    }

    public function add() {
        return view('admin.parking_slots.add');
    }

    public function create(Request $request) {
        $p_slot = new ParkingSlot;
        $p_slot->rate = $request->rate;
        $p_slot->save();

        return redirect('/admin/parking');
    }

    public function edit(Request $request) {
        $p_slot = ParkingSlot::find($request->id);
        return view('admin.parking_slots.edit')->with("p_slot", $p_slot);
    }

    public function update(Request $request) {
        $p_slot = ParkingSlot::find($request->id);

        $p_slot->update([
            'rate' => $request->rate,
        ]);

        return redirect('/admin/parking');
    }

    public function delete(Request $request) {
        $p_slot = ParkingSlot::find($request->id);
        $p_slot->delete();
        
        return redirect('/admin/parking');
    }
}
