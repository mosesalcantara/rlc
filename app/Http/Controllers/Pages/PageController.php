<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Building;
use App\Models\Video;
use App\Models\ResidentialUnit;
use App\Models\Snapshot;
use App\Models\ContactItem;
use App\Models\AboutItem;

class PageController extends Controller
{
    public function index() {
        $properties = Property::limit(5)->get();

        foreach ($properties as $property) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->where('properties.id', $property['id'])->limit(1)->get();
            $property['picture'] = $record[0]->picture;

            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.property_id', $property['id'])->get();
            $property['snapshot'] = $record[0]->picture;

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.id', $property['id'])->get();
            $types = '';
            foreach ($record as $item) {
                $types .= ' ' . $item['type'];
            }
            $property['types'] = $types;

            $min = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $property['id'])->min('residential_units.rate');
            $property['min'] = $min;
            $max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $property['id'])->max('residential_units.rate');
            $property['max'] = $max;
        }

        $videos = Video::all()->sortByDesc('updated_at')->take(3);
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

    public function residential_units() {
        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();

        foreach ($r_units as $r_unit) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $r_unit['id'])->get();
            $r_unit['snapshot'] = $record[0]->picture;
        }

        $data = [
            'r_units' => $r_units,
        ];

        return view("pages.residential_units")->with('data', $data);
    }

    public function commercial_units() {
        $c_units = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->get();

        foreach ($c_units as $c_unit) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $c_unit['property_id'])->get();
            $c_unit['picture'] = $record[0]->picture;

            $record = Building::where('id', $c_unit['building_id'])->get();
            $c_unit['building'] = $record[0]['name'];
        }

        $data = [
            'c_units' => $c_units,
        ];

        return view("pages.commercial_units")->with('data', $data);
    }

    public function parking_slots() {
        $slots = Property::selectRaw('properties.id, properties.name, properties.location, Min(parking_slots.rate) As min, Max(parking_slots.rate) As max')
                    ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->groupBy('properties.id')->get();

        foreach ($slots as $slot) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $slot['id'])->get();
            $slot['picture'] = $record[0]->picture;
        }

        $data = [
            'slots' => $slots,
        ];

        return view("pages.parking_slots")->with('data', $data);
    }

    public function residential_unit(Request $request) {
        $r_unit = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('residential_units.id', $request->id)->get();
        $r_unit = $r_unit[0];

        $record = Building::where('id', $r_unit['building_id'])->get();
        $r_unit['building'] = $record[0]['name'];

        $records = Snapshot::all()->where('residential_unit_id', $request->id);
        $snapshots = [];

        foreach ($records as $snapshot) {
            array_push($snapshots, $snapshot['picture']);
        }
        $r_unit['snapshots'] = $snapshots;

        $records = Property::select('amenities.id', 'amenities.name', 'amenities.type', 'amenities.picture')
                    ->join('amenities', 'properties.id', '=', 'amenities.property_id')->where('properties.id', $r_unit['property_id'])->get();
        $amenities = [];
        
        foreach ($records as $amenity) {
            array_push($amenities, $amenity);
        }
        $r_unit['amenities'] = $amenities;

        $data = [
            'r_unit' => $r_unit,
        ];
        return view('pages.residential_unit')->with('data', $data);
    }

    public function commercial_unit(Request $request) {
        $c_unit = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('commercial_units.id', $request->id)->get();
        $c_unit = $c_unit[0];

        $record = Building::where('id', $c_unit['building_id'])->get();
        $c_unit['building'] = $record[0]['name'];
        $c_unit['floor_plan'] = $record[0]['floor_plan'];

        $measurements = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->get();

        $data = [
            'c_unit' => $c_unit,
            'measurements' => $measurements,
        ];
        return view('pages.commercial_unit')->with('data', $data);
    }

    public function parking_slot(Request $request) {
        $property = Property::selectRaw('properties.id, properties.name, properties.location, properties.logo, Min(parking_slots.rate) as min, Max(parking_slots.rate) as max')
                    ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->groupBy('properties.id')->where('properties.id', $request->id)->get();
        $property = $property[0];

        $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('properties.id', $property['id'])->get();
        $property['picture'] = $record[0]->picture;

        $records = Property::join('terms', 'properties.id', '=', 'terms.property_id')->where('properties.id', $property['id'])->orderBy('category')->get();
        $terms = [
            'Lease Term' => [],
            'Payment Term' => [],
            'Mode of Payment' => [],
            'Documents' => [],
            'Important Notice' => [],
        ];
        foreach ($records as $record) {
            array_push($terms[$record['category']], $record['description']);
        }
        $property['terms'] = $terms;

        $slots = Property::join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where('properties.id', $property['id'])->get();

        $data = [
            'property' => $property,
            'slots' => $slots,
        ];
        return view('pages.parking_slot')->with('data', $data);
    }

    public function property(Request $request) {
        $property = Property::where('id', $request->id)->get();
        $property = $property[0];

        $records = Property::select('pictures.picture')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('properties.id', $request->id)->get();
        $pictures = [];
        foreach ($records as $record) {
            array_push($pictures, $record->picture);
        }
        $property['pictures'] = $pictures;

        $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.id', $request->id)->get();
        $types = '';
        foreach ($record as $item) {
            $types .= ' ' . $item['type'];
        }
        $property['types'] = $types;

        $min = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $request->id)->min('residential_units.rate');
        $property['min'] = $min;
        $max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $request->id)->max('residential_units.rate');
        $property['max'] = $max;

        $records = Property::select('amenities.id', 'amenities.name', 'amenities.type', 'amenities.picture')
                    ->join('amenities', 'properties.id', '=', 'amenities.property_id')->where('properties.id', $request->id)->get();
        $indoor = [];
        $outdoor = [];

        foreach ($records as $amenity) {
            if ($amenity->type == 'Indoor') {
                array_push($indoor, $amenity);
            }
            else {
                array_push($outdoor, $amenity);
            }
        }
        $property['indoor'] = $indoor;
        $property['outdoor'] = $outdoor;

        $data = [
            'property' => $property,
        ];
        return view('pages.property')->with('data', $data);
    }

    public function properties() {
        return view("pages.properties");
    }

    public function get_residential_units() {
        $records = Property::selectRaw('properties.name, properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->groupByRaw('properties.name, properties.location')->havingRaw('Count(residential_units.id) > 0')->get();
        $locations = Property::selectRaw('properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->groupByRaw('properties.location, properties.id')
                        ->havingRaw('Count(residential_units.id) > 0')->get();
        $properties = [];

        foreach ($locations as $location) {
            $properties[$location['location']] = [];
        }

        foreach ($records as $record) {
            array_push($properties[$record['location']], $record['name']);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    }

    public function get_commercial_units() {
        $records = Property::selectRaw('properties.id, properties.name, properties.location, Count(commercial_units.id) As commercial_units')
                    ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->groupByRaw('properties.name, properties.location, properties.id')
                    ->havingRaw('Count(commercial_units.id) > 0')->get();
        $locations = Property::selectRaw('properties.location, Count(commercial_units.id) As commercial_units')
                        ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->groupByRaw('properties.location, properties.id')
                        ->havingRaw('Count(commercial_units.id) > 0')->get();
        $properties = [];

        foreach ($locations as $location) {
            $properties[$location['location']] = [];
        }

        foreach ($records as $record) {
            array_push($properties[$record['location']], $record['name']);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    }

    public function compare_residential_properties(Request $request) {
        $selected_properties = $request['selected_properties'];
        $properties = [];

        foreach ($selected_properties as $property) {
            $details = [];

            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.name', $property)->get();
            $details['picture'] = $record[0]['picture'];
            $details['location'] = $record[0]['location'];
            $details['name'] = $property;

            $property_types = '';
            $record = Property::selectRaw('properties.name, properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->groupByRaw('properties.name, properties.location')->havingRaw('Count(residential_units.id) > 0')->get();
            if ($record[0]['residential_units'] > 0) {
                $property_types .= ' Residential';
            }

            $record = Property::selectRaw('properties.name, properties.location, Count(commercial_units.id) As commercial_units')
                        ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->groupByRaw('properties.name, properties.location')->havingRaw('Count(commercial_units.id) > 0')->get();
            if ($record[0]['commercial_units'] > 0) {
                $property_types .= ' Commercial';
            }

            $details['property_types'] = $property_types;

            $details['min_rate'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.name', $property)->min('residential_units.rate');
            $details['max_rate'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.name', $property)->max('residential_units.rate');

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.name', $property)->get();
            $types = '';
            foreach ($record as $item) {
                $types .= ' ' . $item['type'];
            }
            $details['types'] = $types;

            $details['min_area'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.name', $property)->min('residential_units.area');
            $details['max_area'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.name', $property)->max('residential_units.area');

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.status')->where('properties.name', $property)->get();
            $statuses = '';
            foreach ($record as $item) {
                $statuses .= ' ' . $item['status'];
            }
            $details['statuses'] = $statuses;

            array_push($properties, $details);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    }

    public function compare_commercial_properties(Request $request) {
        $selected_properties = $request['selected_properties'];
        $properties = [];

        foreach ($selected_properties as $property) {
            $details = [];
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.name', $property)->get();
            $details['picture'] = $record[0]['picture'];
            $details['location'] = $record[0]['location'];
            $details['name'] = $property;

            $details['min_area'] = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where('properties.name', $property)->min('commercial_units.size');
            $details['max_area'] = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where('properties.name', $property)->max('commercial_units.size');

            array_push($properties, $details);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    } 

    public function compare_residential_units(Request $request) {
        $request_data = $request->all();
        $selected_properties = $request_data['selected_properties'];
        $properties = [];

        foreach ($selected_properties as $property) {
            $where = [
                ['residential_units.rate', '>=', $request_data['min_rate']],
                ['residential_units.rate', '<=', $request_data['max_rate']],
                ['residential_units.area', '>=', $request_data['min_area']],
                ['residential_units.area', '<=', $request_data['max_area']],
                ['properties.name', $property],
            ];

            $details = [];

            $details['name'] = $property;

            $record = Property::selectRaw('properties.name, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')
                        ->where($where)->whereIn('type', $request_data['types'])->whereIn('status', $request_data['statuses'])->groupByRaw('properties.name')->get();
            $details['count'] = $record[0]['residential_units'];

            $records = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')
                        ->where($where)->whereIn('type', $request_data['types'])->whereIn('status', $request_data['statuses'])->get();
            foreach ($records as $record) {
                $snapshot = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                                ->where('residential_units.id', $record['id'])->get();
                $record['snapshot'] = $snapshot[0]->picture;
            }
            $details['units'] = $records;

            array_push($properties, $details);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    }

    public function compare_commercial_units(Request $request) {
        $request_data = $request->all();
        $selected_properties = $request_data['selected_properties'];
        $properties = [];

        foreach ($selected_properties as $property) {
            $where = [
                ['properties.name', $property],
                ['commercial_units.size', '>=', $request_data['min_area']],
                ['commercial_units.size', '<=', $request_data['max_area']],
            ];

            $details = [];

            $details['name'] = $property;

            $record = Property::selectRaw('properties.name, Count(commercial_units.id) As commercial_units')
                        ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')
                        ->where($where)->groupByRaw('properties.name')->get();
            $details['count'] = $record[0]['commercial_units'];

            $records = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where($where)->get();
            foreach ($records as $record) {
                $picture = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                            ->where('properties.id', $record['property_id'])->get();
                $record['picture'] = $picture[0]->picture;

                $building = Building::where('id', $record['building_id'])->get();
                $record['building'] = $building[0]['name'];
            }
            $details['units'] = $records;

            array_push($properties, $details);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    }

    public function contact() {
        $contact_items = ContactItem::all()->sortByDesc('updated_at')->take(1);

        $data = [
            'contact_items' => $contact_items[0],
        ];
        return view("pages.contact")->with('data', $data);
    }

    public function about() {
        $about = AboutItem::all()->sortByDesc('updated_at')->take(1);
        $about = $about[0];
        $articles = AboutItem::join('articles', 'about_items.id', '=', 'articles.about_item_id')->orderBy('about_items.id')->limit(3)->get();
    
        $data = [
            'about' => $about,
            'articles' => $articles,
        ];
        return view("pages.about")->with('data', $data);
    }
}