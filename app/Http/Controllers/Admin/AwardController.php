<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Award;

class AwardController extends Controller
{
    public function index() {
        return view('admin.awards.index');
    }

    public function get_all() {
        $records = Award::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'title'=>'required',
            'picture'=>'required|image',
            'date'=>'required',
        ]);

        $record = new Award;
        if($request->hasFile('picture')) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/awards/pictures';
            $file->move($destination, $filename);

            $record->picture = $filename;
        }

        $record->title = $request->title;
        $record->date = $request->date;
        $record->save();

        return response(['msg' => 'Added Award']);
    }

    public function edit(Request $request) {
        $record = Award::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'title'=>'required',
            'date'=>'required',
        ]);
        
        $record = Award::find($request->upd_id);
        if($request->hasFile('picture')) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/awards/pictures';
            $file->move($destination, $filename);

            $record->update([
                'title' => $request->title,
                'picture' => $filename,
                'date' => $request->date,
            ]);
        }
        else {
            $record->update([
                'title' => $request->title,
                'date' => $request->date,
            ]);
        }

        return response(['msg' => 'Updated Award']);
    }

    public function delete(Request $request) {
        $record = Award::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Award']);
    }
}
