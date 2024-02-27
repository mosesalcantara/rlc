<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Snapshot;

class SnapshotController extends Controller
{
    public function index() {
        $snapshots = Snapshot::crossJoin('residential_units')->get();
        
        return view('admin.snapshots.index')->with('snapshots', $snapshots);
    }

    public function add() {
        return view('admin.snapshots.add');
    }

    public function create(Request $request) {
        $snapshot = new Snapshot;

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->file('picture');
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/residential_units/snapshots';
            $file->move( $destination, $filename );
        }

        $snapshot->picture = $filename;
        $snapshot->residential_unit_id = $request->residential_unit_id;
        $snapshot->save();

        return redirect('/admin/snapshots');
    }

    public function edit(Request $request) {
        $snapshot = Snapshot::find($request->id);
        return view('admin.snapshots.edit')->with("snapshot", $snapshot);
    }

    public function update(Request $request) {
        $snapshot = Snapshot::find($request->id);

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->file('picture');
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/picture';
            $file->move($destination, $filename );

            $snapshot->update([
                'picture' => $filename,
                'residential_unit_id' => $request->residential_unit_id,
            ]);

        }

        return redirect('/admin/snapshots');
    }

    public function delete(Request $request) {
        $snapshot = Snapshot::find($request->id);
        $snapshot->delete();
        
        return redirect('/admin/snapshots');
    }
}
