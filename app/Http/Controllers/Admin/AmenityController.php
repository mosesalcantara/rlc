<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    public function index() {
        $amenities = Amenity::all();
        
        return view('admin.amenities.index')->with('amenities', $amenities);
    }

    public function add() {
        return view('admin.amenities.add');
    }

    public function create(Request $request) {
        $amenity = new Amenity;

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->file('picture');
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/picture';
            $file->move( $destination, $filename );
        }

        $amenity->name = $request->name;
        $amenity->type = $request->type;
        $amenity->picture = $filename;
        $amenity->save();

        return redirect('/admin/amenities');
    }

    public function edit(Request $request) {
        $amenity = Amenity::find($request->id);
        return view('admin.amenities.edit')->with("amenity", $amenity);
    }

    public function update(Request $request) {
        $amenity = Amenity::find($request->id);

        if( $request->hasFile( 'picture' ) ) {
            $file = $request->file('picture');
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/amenities/picture';
            $file->move($destination, $filename );

            $amenity->update([
                'name' => $request->name,
                'type' => $request->type,
                'picture' => $filename,
            ]);

        }

        return redirect('/admin/amenities');
    }

    public function delete(Request $request) {
        $amenity = Amenity::find($request->id);
        $amenity->delete();
        
        return redirect('/admin/amenities');
    }
}
