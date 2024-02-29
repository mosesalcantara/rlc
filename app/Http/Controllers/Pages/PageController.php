<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Video;
use App\Models\ResidentialUnit;
use App\Models\Property;

class PageController extends Controller
{

    public function test() {
        $snapshots = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->get();
        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();
        // foreach ($r_units as $r_unit) {
        //     $r_unit['picture'] = '1708999227.jpg';
        // }

        $data = [
            'snapshots' => $snapshots,
            'r_units' => $r_units,
        ];

        return view("pages.test")->with('data', $data);
        // return view("pages.test")->with('r_units', $r_units);
    }

    public function index() {
        $videos = Video::all()->sortByDesc('updated_at')->take(2);

        $data = [
            'videos' => $videos,
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
