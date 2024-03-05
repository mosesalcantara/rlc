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

    public function get_all() {
        $records = AboutItem::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new AboutItem;

        if( $request->hasFile( 'heading_image' ) ) {
            $file = $request->heading_image;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/about_items/heading_images';
            $file->move( $destination, $filename );
        }

        $record->heading_title = $request->heading_title;
        $record->heading_image = $filename;
        $record->description = $request->description;
        $record->tagline_title = $request->tagline_title;
        $record->tagline = $request->tagline;
        $record->video_code = $request->video_code;
        $record->video_title = $request->video_title;
        $record->video_description = $request->video_description;
        $record->save();

        return response(['msg' => 'Added About Item']);
    }

    public function edit(Request $request) {
        $record = AboutItem::find($request->upd_id);

        $data = [
            'record' => $record,
        ];

        return response()->json($data);
    }

    public function update(Request $request) {
        $record = AboutItem::find($request->upd_id);

        if( $request->hasFile( 'heading_image' ) ) {
            $file = $request->heading_image;
            $filename = time() . '.'.$file->clientExtension();
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



        return response(['msg' => 'Updated About Item']);
    }


    public function delete(Request $request) {
        $record = AboutItem::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted About Item']);
    }
}
