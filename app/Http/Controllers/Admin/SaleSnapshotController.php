<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SaleSnapshot;
use App\Models\SaleUnit;

class SaleSnapshotController extends Controller
{
    public function index() {
        return view('admin.sale_snapshots.index');
    }

    public function get_all() {
        $records = SaleUnit::join('sale_snapshots', 'sale_units.id', '=', 'sale_snapshots.sale_unit_id')->get();
        
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
            'picture'=>'required',
            'sale_unit_id'=>'required',
        ]);

        if( $request->hasFile( 'picture' ) ) {
            foreach ($request->picture as $file) {
                $filename = mt_rand() . '.'.$file->clientExtension();
                $destination = 'uploads/sale_units/snapshots';
                $file->move( $destination, $filename );
    
                $record = new SaleSnapshot;
                $record->picture = $filename;
                $record->sale_unit_id = $request->sale_unit_id;
                $record->save();   
            } 
        }

        return response(['msg' => 'Added Snapshots']);
    }

    public function edit(Request $request) {
        $record = SaleUnit::join('sale_snapshots', 'sale_units.id', '=', 'sale_snapshots.sale_unit_id')->where('sale_snapshots.id', $request->upd_id)->get();
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

        $record = SaleSnapshot::find($request->upd_id);

        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/sale_units/snapshots';
            $file->move($destination, $filename );

            $record->update([
                'picture' => $filename,
                'sale_unit_id' => $request->sale_unit_id,
            ]);
        }
        else {
            $record->update([
                'sale_unit_id' => $request->sale_unit_id,
            ]);
        }

        return response(['msg' => 'Updated Snapshot']);
    }

    public function delete(Request $request) {
        $record = SaleSnapshot::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Snapshot']);
    }
}
