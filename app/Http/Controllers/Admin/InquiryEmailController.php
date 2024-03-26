<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InquiryEmail;

class InquiryEmailController extends Controller
{
    public function index() {
        return view('admin.inquiry_emails.index');
    }

    public function get_all() {
        $records = InquiryEmail::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'type'=>'required',
            'fullname'=>'required',
            'email'=>'required|email',
            'contact_number'=>'required',
            'message'=>'required',
        ]);

        $record = new InquiryEmail;

        $record->type = $request->type;
        $record->fullname = $request->fullname;
        $record->email = $request->email;
        $record->contact_number = $request->contact_number;
        $record->message = $request->message;
        $record->save();

        return response(['msg' => 'Added Inquiry Email']);
    }

    public function edit(Request $request) {
        $record = InquiryEmail::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'type'=>'required',
            'fullname'=>'required',
            'email'=>'required|email',
            'contact_number'=>'required',
            'message'=>'required',
        ]);

        $record = InquiryEmail::find($request->upd_id);

        $record->update([
            'type' => $request->type,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'message' => $request->message,
        ]);

        return response(['msg' => 'Updated Inquiry Email']);
    }

    public function delete(Request $request) {
        $record = InquiryEmail::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Inquiry Email']);
    }
}
