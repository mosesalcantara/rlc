<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Property;

class ReviewController extends Controller
{
    public function index() {
        return view('admin.reviews.index');
    }

    public function get_all() {
        $records = Property::join('reviews', 'properties.id', '=', 'reviews.property_id')->get();
        
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
            'picture'=>'image',
            'fullname'=>'required',
            'property_id'=>'required',
            'reviewed_on'=>'required',
            'review'=>'required',
            'publish_status'=>'required',
        ]);

        $record = new Review;
        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/reviews/profile_pics';
            $file->move($destination, $filename);

            $record->picture = $filename;
        }
        else {
            $record->picture = 'profile_pic.png';
        }

        $record->fullname = $request->fullname;
        $record->property_id = $request->property_id;
        $record->reviewed_on = $request->reviewed_on;
        $record->review = $request->review;
        $record->publish_status = $request->publish_status;
        $record->save();

        return response(['msg' => 'Added Review']);
    }

    public function edit(Request $request) {
        $record = Property::join('reviews', 'properties.id', '=', 'reviews.property_id')->where('reviews.id', $request->upd_id)->get();
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
            'picture'=>'image',
            'fullname'=>'required',
            'property_id'=>'required',
            'reviewed_on'=>'required',
            'review'=>'required',
            'publish_status'=>'required',
        ]);
        
        $record = Review::find($request->upd_id);
        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = mt_rand() . '.'.$file->clientExtension();
            $destination = 'uploads/reviews/profile_pics';
            $file->move($destination, $filename);

            $record->update([
                'picture' => $filename,
                'fullname' => $request->fullname,
                'property_id' => $request->property_id,
                'reviewed_on' => $request->reviewed_on,
                'review' => $request->review,
                'publish_status'=>$request->publish_status,
            ]);
        }
        else {
            $record->update([
                'fullname' => $request->fullname,
                'property_id' => $request->property_id,
                'reviewed_on' => $request->reviewed_on,
                'review' => $request->review,
                'publish_status' => $request->publish_status,
            ]);
        }

        return response(['msg' => 'Updated Review']);
    }

    public function delete(Request $request) {
        $record = Review::find($request->del_id);
        $record->delete();
        
        return response(['msg' => 'Deleted Review']);
    }
}
