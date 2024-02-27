<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Snapshot;
use App\Models\ResidentialUnit;

class SnapshotController extends Controller
{
    public function index() {
        $snapshots = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->get();
        
        return view('admin.snapshots.index')->with('snapshots', $snapshots);
    }

    public function add() {
        $r_units = ResidentialUnit::all();

        return view('admin.snapshots.add')->with('r_units', $r_units);
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
        $snapshot = ResidentialUnit::leftJoin('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->where('snapshots.id', $request->id)->get();
        $r_units = ResidentialUnit::all();

        $data = [
            'snapshot' => $snapshot,
            'r_units' => $r_units,
        ];

        return view('admin.snapshots.edit')->with("data", $data);
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
