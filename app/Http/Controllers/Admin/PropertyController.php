<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index() {
        $properties = Property::all();
        
        return view('admin.properties.index')->with('properties', $properties);
    }

    public function add() {
        return view('admin.properties.add');
    }

    public function create(Request $request) {
        $property = new Property;

        if( $request->hasFile( 'logo' ) ) {
            $file = $request->file('logo');
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/properties/logo';
            $file->move( $destination, $filename );
        }

        $property->logo = $filename;
        $property->name = $request->name;
        $property->location = $request->location;
        $property->description = $request->description;
        $property->save();

        return redirect('/admin/properties');
    }

    public function edit(Request $request) {
        $property = Property::find($request->id);
        return view('admin.properties.edit')->with("property", $property);
    }

    public function update(Request $request) {
        var_dump($request->logo);
        $property = Property::find($request->id);

        if( $request->hasFile( 'logo' ) ) {
            $file = $request->file('logo');
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/properties/logo';
            $file->move($destination, $filename );

            $property->update([
                'logo' => $filename,
                'name' => $request->name,
                'location' => $request->location,
                'description' => $request->description,
            ]);    
        }

        return redirect('/admin/properties');
    }

    public function delete(Request $request) {
        $property = Property::find($request->id);
        $property->delete();
        
        return redirect('/admin/properties');
    }
}
