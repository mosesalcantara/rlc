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
        $properties = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->limit(10)->get();
        $first_property_snapshot = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')
                                    ->join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                                    ->where('properties.id', 5)->get();
        $first_property_types = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.id', 5)->get();
        $first_property_min = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', 5)->min('residential_units.rate');
        $first_property_max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', 5)->max('residential_units.rate');

        $videos = Video::all()->sortByDesc('updated_at')->take(2);
        $reviews = Property::join('reviews', 'properties.id', '=', 'reviews.property_id')->orderBy('reviews.updated_at', 'desc')->limit(10)->get();

        $data = [
            'first_property' => $properties[0],
            'first_property_snapshot' => $first_property_snapshot[0],
            'first_property_types' => $first_property_types,
            'first_property_min' => $first_property_min,
            'first_property_max' => $first_property_max,
            'first_video' => $videos[0],
            'videos' => $videos->slice(1),
            'first_review' => $reviews[0],
            'reviews' => $reviews->slice(1),
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
