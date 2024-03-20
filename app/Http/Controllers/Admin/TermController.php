<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Term;
use App\Models\Property;

class TermController extends Controller
{
    public function index() {
        return view('admin.terms.index');
    }

    public function get_all() {
        $records = Property::join('terms', 'properties.id', '=', 'terms.property_id')->get();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function get_related() {
        $records = Property::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'property_id'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);

        $record = new Term;

        $record->description = $request->description;
        $record->category = $request->category;
        $record->property_id = $request->property_id;
        $record->save();

        return response(['msg' => 'Added Term']);
    }

    public function edit(Request $request) {
        $record = Property::join('terms', 'properties.id', '=', 'terms.property_id')->where('terms.id', $request->upd_id)->get();
        $record = $record[0];
        $records = Property::all();

        $data = [
            'record' => $record,
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'property_id'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);
        
        $record = Term::find($request->upd_id);

        $record->update([
            'description' => $request->description,
            'category' => $request->category,
            'property_id' => $request->property_id,
        ]);

        return response(['msg' => 'Updated Term']);
    }

    public function delete(Request $request) {
        $record = Term::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Term']);
    }
}
