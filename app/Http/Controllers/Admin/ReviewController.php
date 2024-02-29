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

    public function get_related() {
        $records = Property::all();
        
        $data = [
            'records' => $records,
        ];

        return response()->json($data);
    }

    public function create(Request $request) {
        $record = new Review;

        if( $request->hasFile('picture') ) {
            $file = $request->picture;
            $filename = time() . '.'.$file->clientExtension();
            $destination = 'uploads/reviews/profile_pics';
            $file->move($destination, $filename);

            $record->picture = $request->filename;
        }
        else {
            $record->picture = 'profile_pic.png';
        }

        $record->fullname = $request->fullname;
        $record->property_id = $request->property_id;
        $record->reviewed_on = $request->reviewed_on;
        $record->review = $request->review;
        $record->save();

        return response(['msg' => 'Added Review']);
    }
}
