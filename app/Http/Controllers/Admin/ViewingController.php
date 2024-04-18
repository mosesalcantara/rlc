<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Viewing;

class ViewingController extends Controller
{
    public function index() {
        return view('admin.viewings.index');
    }

    public function get_all() {
        $records = Viewing::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'date'=>'required',
            'time'=>'required',
            'message'=>'required',
            'status'=>'required',
        ]);

        $record = new Viewing;

        $record->name = $request->name;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->date = $request->date;
        $record->time = $request->time;
        $record->message = $request->message;
        $record->status = $request->status;
        $record->save();

        return response(['msg' => 'Added Viewing']);
    }

    public function edit(Request $request) {
        $record = Viewing::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'date'=>'required',
            'time'=>'required',
            'message'=>'required',
            'status'=>'required',
        ]);

        $record = Viewing::find($request->upd_id);

        $record->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'message' => $request->message,
            'status' => $request->status,
        ]);

        return response(['msg' => 'Updated Viewing']);
    }

    public function delete(Request $request) {
        $record = Viewing::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Viewing']);
    }
}
