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
        $records = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->limit(5)->get();
        $properties = [];

        foreach ($records as $property) {
            $details = [
                'picture' => $property['picture'],
                'name' => $property['name'],
                'description' => $property['description'],
                'location' => $property['location'],
                'snapshot' => '',
                'types' => '',
                'min' => '',
                'max' => '',
            ];
            
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.property_id', $property['property_id'])->get();
            $details['snapshot'] = $record[0]->picture;

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.id', $property['property_id'])->get();
            $types = '';

            foreach ($record as $item) {
                $types .= ' ' . $item['type'];
            }
            $details['types'] = $types;

            $min = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $property['property_id'])->min('residential_units.rate');
            $details['min'] = $min;
            $max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $property['property_id'])->max('residential_units.rate');
            $details['max'] = $max;

            array_push($properties, $details);
        }

        $videos = Video::all()->sortByDesc('updated_at')->take(2);
        $reviews = Property::join('reviews', 'properties.id', '=', 'reviews.property_id')->orderBy('reviews.updated_at', 'desc')->limit(10)->get();

        $data = [
            'properties' => $properties,
            'videos' => $videos,
            'reviews' => $reviews,
        ];

        return view("pages.index")->with('data', $data);
    }

    public function lease() {
        return view("pages.lease");
    }

    public function category() {
        $records = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();
        $r_units = [];

        foreach ($records as $r_unit) {
            $details = [
                'snapshot' => '',
                'name' => $r_unit['name'],
                'location' => $r_unit['location'],
                'unit_id' => $r_unit['unit_id'],
                'type' => $r_unit['type'],
                'rate' => $r_unit['rate'],
                'area' => $r_unit['area'],
            ];

            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $r_unit['id'])->get();
            $details['snapshot'] = $record[0]->picture;
            array_push($r_units, $details);
        }

        $data = [
            'r_units' => $r_units,
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
