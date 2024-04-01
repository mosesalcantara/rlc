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

    public function edit() {
        $record = ContactItem::first();

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'heading_title'=>'required',
            'heading_image'=>'image',
            'title'=>'required',
            'subtitle'=>'required',
        ]);

        $record = ContactItem::find($request->upd_id);

        if( $request->hasFile('heading_image') ) {
            $file = $request->heading_image;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/contact_items/heading_images';
            $file->move($destination, $filename );

            $record->update([
                'heading_title' => $request->heading_title,
                'heading_image' => $filename,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);
        }
        else {
            $record->update([
                'heading_title' => $request->heading_title,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);
        }

        return response(['msg' => 'Updated Contact Us']);
    }
}
