<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use App\Mail\AnnouncementMail;

use App\Models\Announcement;
use App\Models\Subscriber;

class AnnouncementController extends Controller
{
    public function index() {
        return view('admin.announcements.index');
    }

    public function get_all() {
        $records = Announcement::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'publish_status'=>'required',
        ]);

        $record = new Announcement;

        $record->title = $request->title;
        $record->body = $request->body;
        $record->publish_status = $request->publish_status;
        $record->save();

        return response(['msg' => 'Added Announcement']);
    }

    public function edit(Request $request) {
        $record = Announcement::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'publish_status'=>'required',
        ]);

        $record = Announcement::find($request->upd_id);

        $record->update([
            'title' => $request->title,
            'body' => $request->body,
            'publish_status' => $request->publish_status,
        ]);

        if ($request->publish_status == 'Published') {
            $mail_data = [
                'title' => $request->title,
                'body' => $request->body,
            ];

            $recipients = Subscriber::select('email')->get();
            foreach ($recipients as $recipient) {
                Mail::to($recipient['email'])->send(new AnnouncementMail($mail_data));
            }
        }

        return response(['msg' => 'Updated Announcement']);
    }

    public function delete(Request $request) {
        $record = Announcement::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Announcement']);
    }
}
