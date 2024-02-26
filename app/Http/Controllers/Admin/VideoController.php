<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index() {
        $videos = Video::all();
        
        return view('admin.videos.index')->with('videos', $videos);
    }

    public function add() {
        return view('admin.videos.add');
    }

    public function create(Request $request) {
        $video = new Video;
        $video->code = $request->code;
        $video->save();

        return redirect('/admin/videos');
    }

    public function edit(Request $request) {
        $video = Video::find($request->id);
        return view('admin.videos.edit')->with("video", $video);
    }

    public function update(Request $request) {
        $video = Video::find($request->id);

        $video->update([
            'code' => $request->code,
        ]);

        return redirect('/admin/videos');
    }

    public function delete(Request $request) {
        $video = Video::find($request->id);
        $video->delete();
        
        return redirect('/admin/videos');
    }
}
