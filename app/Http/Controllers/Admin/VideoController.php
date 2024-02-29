<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index() {
        return view('admin.videos.index');
    }

    public function get_all() {
        $records = Video::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new Video;
        $record->code = $request->code;
        $record->save();

        return response(['msg' => 'Added Video']);
    }

    public function edit(Request $request) {
        $record = Video::find($request->upd_id);
        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Video::find($request->upd_id);

        $record->update([
            'code' => $request->code,
        ]);

        return response(['msg' => 'Updated Video']);
    }

    public function delete(Request $request) {
        $record = Video::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Video']);
    }
}
