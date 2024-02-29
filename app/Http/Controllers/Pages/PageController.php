<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Video;
use App\Models\Review;
use App\Models\ResidentialUnit;
use App\Models\Property;

class PageController extends Controller
{

    public function test() {
        return view("pages.test");
    }

    public function index() {
        $videos = Video::all()->sortByDesc('updated_at')->take(2);
        $first = Property::join('reviews', 'properties.id', '=', 'reviews.property_id')->orderBy('reviews.updated_at', 'desc')->limit(1)->get();
        $reviews = Property::join('reviews', 'properties.id', '=', 'reviews.property_id')->orderBy('reviews.updated_at', 'desc')->limit(10)->whereNot('reviews.id', $first[0]['id'])->get();

        $data = [
            'videos' => $videos,
            'first' => $first,
            'reviews' => $reviews,
        ];

        return view("pages.index")->with('data', $data);
    }

    public function lease() {
        return view("pages.lease");
    }

    public function category(Request $request) {
        $records = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->get();

        $data = [
            'records' => $records,
        ];

        return view("pages.category")->with('data', $data);
    }

    public function unit() {
        return view('pages.unit');
    }

    public function properties() {
        return view("pages.properties");
    }

    public function contact() {
        return view("pages.contact");
    }

    public function about() {
        return view("pages.about");
    }
}
