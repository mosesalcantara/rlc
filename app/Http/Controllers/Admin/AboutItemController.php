<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AboutItem;

class AboutItemController extends Controller
{
    public function index() {
        return view('admin.about_items.index');
    }

    public function edit() {
        $record = AboutItem::first();

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $request->validate([
            'heading_title'=>'required',
            'heading_image'=>'image',
            'description'=>'required',
            'tagline_title'=>'required',
            'tagline'=>'required',
            'video_code'=>'required',
            'video_title'=>'required',
            'video_description'=>'required',
        ]);

        $record = AboutItem::find($request->upd_id);

        if( $request->hasFile( 'heading_image' ) ) {
            $file = $request->heading_image;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/about_items/heading_images';
            $file->move( $destination, $filename );

            $record->update([
                'heading_title' => $request->heading_title,
                'heading_image' => $filename,
                'description' => $request->description,
                'tagline_title' => $request->tagline_title,
                'tagline' => $request->tagline,
                'video_code' => $request->video_code,
                'video_title' => $request->video_title,
                'video_description' => $request->video_description,
            ]);
        }
        else {
            $record->update([
                'heading_title' => $request->heading_title,
                'description' => $request->description,
                'tagline_title' => $request->tagline_title,
                'tagline' => $request->tagline,
                'video_code' => $request->video_code,
                'video_title' => $request->video_title,
                'video_description' => $request->video_description,
            ]);
        }



        return response(['msg' => 'Updated About Us']);
    }
}
