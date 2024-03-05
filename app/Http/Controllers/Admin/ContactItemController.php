<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactItem;

class ContactItemController extends Controller
{
    public function index() {
        return view('admin.contact_items.index');
    }

    public function get_all() {
        $records = ContactItem::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new ContactItem;

        if( $request->hasFile('heading_image') ) {
            $file = $request->heading_image;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/contact_items/heading_images';
            $file->move($destination, $filename );
        }

        $record->heading_title = $request->heading_title;
        $record->heading_image = $filename;
        $record->title = $request->title;
        $record->subtitle = $request->subtitle;
        $record->email = $request->email;
        $record->save();

        return response(['msg' => 'Added Contact Us Item']);
    }

    public function edit(Request $request) {
        $record = ContactItem::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = ContactItem::find($request->upd_id);

        if( $request->hasFile('heading_image') ) {
            $file = $request->heading_image;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/contact_items/heading_images';
            $file->move($destination, $filename );

            $record->update([
                'heading_title' => $request->heading_title,
                'heading_image' => $filename,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'email' => $request->email,
            ]);
        }
        else {
            $record->update([
                'heading_title' => $request->heading_title,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'email' => $request->email,
            ]);
        }

        return response(['msg' => 'Updated Contact Us Item']);
    }


    public function delete(Request $request) {
        $record = ContactItem::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Contact Us Item']);
    }
}
