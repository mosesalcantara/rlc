<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Snapshot;
use App\Models\ResidentialUnit;

class SnapshotController extends Controller
{
    public function index() {
        return view('admin.snapshots.index');
    }

    public function get_all() {
        $records = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->get();
        
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
        if( $request->hasFile( 'picture' ) ) {
            foreach ($request->picture as $file) {
                $filename = time() . '.'.$file->clientExtension();
                $destination = 'uploads/residential_units/snapshots';
                $file->move( $destination, $filename );
    
                $record = new Snapshot;
                $record->picture = $filename;
                $record->residential_unit_id = $request->residential_unit_id;
                $record->save();   
            } 
        }

        return response(['msg' => 'Added Snapshots']);
    }

    public function edit(Request $request) {
        $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->where('snapshots.id', $request->upd_id)->get();
        $record = $record[0];
        $records = ResidentialUnit::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = Snapshot::find($request->upd_id);

        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/residential_units/snapshots';
            $file->move($destination, $filename );

            $record->update([
                'picture' => $filename,
                'residential_unit_id' => $request->residential_unit_id,
            ]);
        }
        else {
            $record->update([
                'residential_unit_id' => $request->residential_unit_id,
            ]);
        }

        return response(['msg' => 'Updated Snapshot']);
    }

    public function delete(Request $request) {
        $record = Snapshot::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Snapshot']);
    }
}
