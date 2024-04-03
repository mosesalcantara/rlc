<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SaleUnitVideo;
use App\Models\SaleUnit;

class SaleUnitVideoController extends Controller
{
    public function index() {
        return view('admin.sale_unit_videos.index');
    }

    public function get_all() {
        $records = SaleUnit::join('sale_unit_videos', 'sale_units.id', '=', 'sale_unit_videos.sale_unit_id')->get();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function get_related() {
        $records = SaleUnit::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'video'=>'required',
            'sale_unit_id'=>'required',
        ]);

        if( $request->hasFile( 'video' ) ) {
            foreach ($request->video as $file) {
                $filename = mt_rand() . '.'.$file->clientExtension();
                $destination = 'uploads/sale_units/unit_videos';
                $file->move( $destination, $filename );
    
                $record = new SaleUnitVideo;
                $record->video = $filename;
                $record->sale_unit_id = $request->sale_unit_id;
                $record->save();   
            } 
        }

        return response(['msg' => 'Added Unit Videos']);
    }

    public function edit(Request $request) {
        $record = SaleUnit::join('sale_unit_videos', 'sale_units.id', '=', 'sale_unit_videos.sale_unit_id')->where('sale_unit_videos.id', $request->upd_id)->get();
        $record = $record[0];
        $records = SaleUnit::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'sale_unit_id'=>'required',
        ]);

        $record = SaleUnitVideo::find($request->upd_id);

        if( $request->hasFile('video') ) {
            $file = $request->video;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/sale_units/unit_videos';
            $file->move($destination, $filename );

            $record->update([
                'video' => $filename,
                'sale_unit_id' => $request->sale_unit_id,
            ]);
        }
        else {
            $record->update([
                'sale_unit_id' => $request->sale_unit_id,
            ]);
        }

        return response(['msg' => 'Updated Unit Video']);
    }

    public function delete(Request $request) {
        $record = SaleUnitVideo::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Unit Video']);
    }
}
