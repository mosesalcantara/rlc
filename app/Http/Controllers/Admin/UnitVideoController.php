<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UnitVideo;
use App\Models\ResidentialUnit;

class UnitVideoController extends Controller
{
    public function index() {
        return view('admin.unit_videos.index');
    }

    public function get_all() {
        $records = ResidentialUnit::join('unit_videos', 'residential_units.id', '=', 'unit_videos.residential_unit_id')->get();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function get_related() {
        $records = ResidentialUnit::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'video'=>'required',
            'residential_unit_id'=>'required',
        ]);

        if( $request->hasFile( 'video' ) ) {
            foreach ($request->video as $file) {
                $filename = mt_rand() . '.'.$file->clientExtension();
                $destination = 'uploads/residential_units/unit_videos';
                $file->move( $destination, $filename );
    
                $record = new UnitVideo;
                $record->video = $filename;
                $record->residential_unit_id = $request->residential_unit_id;
                $record->save();   
            } 
        }

        return response(['msg' => 'Added Unit Videos']);
    }

    public function edit(Request $request) {
        $record = ResidentialUnit::join('unit_videos', 'residential_units.id', '=', 'unit_videos.residential_unit_id')->where('unit_videos.id', $request->upd_id)->get();
        $record = $record[0];
        $records = ResidentialUnit::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'residential_unit_id'=>'required',
        ]);

        $record = UnitVideo::find($request->upd_id);

        if( $request->hasFile('video') ) {
            $file = $request->video;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/residential_units/unit_videos';
            $file->move($destination, $filename );

            $record->update([
                'video' => $filename,
                'residential_unit_id' => $request->residential_unit_id,
            ]);
        }
        else {
            $record->update([
                'residential_unit_id' => $request->residential_unit_id,
            ]);
        }

        return response(['msg' => 'Updated Unit Video']);
    }

    public function delete(Request $request) {
        $record = UnitVideo::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Unit Video']);
    }
}
