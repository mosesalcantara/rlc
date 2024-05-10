<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Mail;
use App\Mail\ViewingMail;

use App\Models\Viewing;
use App\Models\ResidentialUnit;
use App\Models\Property;

class ViewingController extends Controller
{
    public function index() {
        return view('admin.viewings.index');
    }

    public function get_all() {
        $records = ResidentialUnit::select('viewings.id', 'viewings.name', 'email', 'phone', 'property_id', 'residential_unit_id', 'unit_id', 'date', 'time', 'message', 'viewings.status')
                    ->join('viewings', 'residential_units.id', '=', 'viewings.residential_unit_id')->get();

        foreach ($records as $record) {
            $property = Property::where('id', $record['property_id'])->get();
            $record['property'] = $property[0]['name'];
        }
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function related_properties() {
        $records = Property::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function related_residential_units(Request $request) {
        $records = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $request->property_id)->get();

        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'residential_unit_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            'message'=>'required',
            'status'=>'required',
        ]);

        $record = new Viewing;

        $record->name = $request->name;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->residential_unit_id = $request->residential_unit_id;
        $record->date = $request->date;
        $record->time = $request->time;
        $record->message = $request->message;
        $record->status = $request->status;
        $record->save();

        return response(['msg' => 'Added Viewing']);
    }

    public function edit(Request $request) {
        $record = ResidentialUnit::select('viewings.id', 'viewings.name', 'email', 'phone', 'property_id', 'residential_unit_id', 'unit_id', 'date', 'time', 'message', 'viewings.status')
                    ->join('viewings', 'residential_units.id', '=', 'viewings.residential_unit_id')->where('viewings.id', $request->upd_id)->get();
        $record = $record[0];

        $property = Property::where('id', $record['property_id'])->get();
        $record['property'] = $property[0]['name'];

        $properties = Property::all();
        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $record['property_id'])->get();
        
        $data = [
            'record' => $record,
            'properties' => $properties,
            'r_units' => $r_units,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'residential_unit_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            'message'=>'required',
            'status'=>'required',
        ]);

        $record = Viewing::find($request->upd_id);

        $record->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'residential_unit_id' => $request->residential_unit_id,
            'date' => $request->date,
            'time' => $request->time,
            'message' => $request->message,
            'status' => $request->status,
        ]);

        if ($request->status != 'Pending') {
            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('residential_units.id', $request->residential_unit_id)->get();
            $record = $record[0];
    
            $mailData = [
                'name' => $request->name,
                'property' => $record['name'],
                'unit_id' => $record['unit_id'],
                'date' => Carbon::parse($request->date)->toFormattedDateString(),
                'time' => Carbon::createFromFormat('H:i:s', $request->time)->format('g:i a'),
                'status' => $request->status,
            ];

            Mail::to($request->email)->send(new ViewingMail($mailData));
        }

        return response(['msg' => 'Updated Viewing']);
    }

    public function delete(Request $request) {
        $record = Viewing::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Viewing']);
    }

    public function change_status($status, $id) {
        $status = ucfirst($status) . 'd';
        $record = Viewing::find($id);
        $unit = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('residential_units.id', $record->residential_unit_id)->first();

        $mailData = [
            'name' => $record->name,
            'unit_id' => $unit['unit_id'],
            'property' => $unit['name'],
            'date' => Carbon::parse($record->date)->toFormattedDateString(),
            'time' => Carbon::createFromFormat('H:i:s', $record->time)->format('g:i a'),
            'status' => $status,
        ];

        $record->update(['status' => $status]);

        Mail::to($record->email)->send(new ViewingMail($mailData));
        
        $data = [
            'status' => $status,
        ];
        return view('admin.viewings.email_status')->with('data', $data);
    }
}
