<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index() {
        return view('admin.subscribers.index');
    }

    public function get_all() {
        $records = Subscriber::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'email'=>'required|email',
        ]);

        $record = new Subscriber;
        $record->email = $request->email;
        $record->save();

        return response(['msg' => 'Added Subscriber']);
    }

    public function edit(Request $request) {
        $record = Subscriber::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'email'=>'required|email',
        ]);

        $record = Subscriber::find($request->upd_id);

        $record->update([
            'email' => $request->email,
        ]);

        return response(['msg' => 'Updated Subscriber']);
    }

    public function delete(Request $request) {
        $record = Subscriber::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Subscriber']);
    }
}
