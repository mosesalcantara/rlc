<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Building;
use App\Models\ResidentialUnit;
use App\Models\Snapshot;
use App\Models\UnitVideo;

class LeaseController extends Controller
{
    public function lease() {
        return view("pages.lease.lease");
    }

    public function residential_units(Request $request) {
        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->orderBy('properties.name')->get();

        foreach ($r_units as $r_unit) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $r_unit['id'])->get();
            $r_unit['snapshot'] = $record[0]->picture;
        }

        $data = [
            'r_units' => $r_units,
        ];

        return view("pages.lease.residential_units")->with('data', $data);
    }

    public function commercial_units(Request $request) {
        $c_units = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->orderBy('properties.name')->get();

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

        return view("pages.lease.commercial_units")->with('data', $data);
    }

    public function parking_slots(Request $request) {
        $slots = Property::selectRaw('properties.id, properties.name, properties.location, Min(parking_slots.rate) As min, Max(parking_slots.rate) As max')
                    ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->orderBy('properties.name')->groupBy('properties.id')->get();

        foreach ($slots as $slot) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $slot['id'])->get();
            $slot['picture'] = $record[0]->picture;
        }

        $data = [
            'slots' => $slots,
        ];

        return view("pages.lease.parking_slots")->with('data', $data);
    }

    public function search_residential_units(Request $request) {
        if ($request['origin'] == 'property_page') {
            $where = [
                ['properties.id', $request['property_id']],
            ];
        }
        else {
            $where = [
                ['properties.location', $request['location']],
                ['residential_units.type', $request['type']],
                ['residential_units.rate', '>=', $request['min_rate']],
                ['residential_units.rate', '<=', $request['max_rate']],
            ];
        }

        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->get();

        foreach ($r_units as $r_unit) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $r_unit['id'])->get();
            $r_unit['snapshot'] = $record[0]->picture;
        }

        $data = [
            'r_units' => $r_units,
        ];

        if ($request['origin'] == 'homepage' || $request['origin'] == 'lease_page' || $request['origin'] == 'residential_unit_page' || $request['origin'] == 'property_page') {
            return view("pages.lease.residential_units")->with('data', $data);
        }
        else {
            return response()->json($data);
        }
    }

    public function search_commercial_units(Request $request) {
        if ($request['origin'] == 'homepage' || $request['origin'] == 'lease_page') {
            $where = [
                ['properties.location', $request['location']],
            ];
        }
        else if ($request['origin'] == 'property_page') {
            $where = [
                ['properties.id', $request['property_id']],
            ];
        }
        else {
            $where = [
                ['properties.location', $request['location']],
                ['commercial_units.size', '>=', $request['min_area']],
                ['commercial_units.size', '<=', $request['max_area']],
            ];
        }

        $c_units = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where($where)->get();
        
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

        if ($request['origin'] == 'homepage' || $request['origin'] == 'lease_page' || $request['origin'] == 'commercial_unit_page' || $request['origin'] == 'property_page') {
            return view("pages.lease.commercial_units")->with('data', $data);
        }
        else {
            return response()->json($data);
        }
    }

    public function search_parking_slots(Request $request) {
        if ($request['origin'] == 'homepage' || $request['origin'] == 'lease_page') {
            $where = [
                ['properties.location', $request['location']],
            ];
    
            $slots = Property::selectRaw('properties.id, properties.name, properties.location, Min(parking_slots.rate) As min, Max(parking_slots.rate) As max')
                        ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where($where)->groupBy('properties.id')->get();
        }
        else if ($request['origin'] == 'property_page') {
            $where = [
                ['properties.id', $request['property_id']],
            ];

            $slots = Property::selectRaw('properties.id, properties.name, properties.location, Min(parking_slots.rate) As min, Max(parking_slots.rate) As max')
                        ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where($where)->groupBy('properties.id')->get();
        }
        else {
            $where = [
                ['properties.location', $request['location']],
                ['properties.name', $request['name']],
            ];
    
            $slots = Property::selectRaw('properties.id, properties.name, properties.location, Min(parking_slots.rate) As min, Max(parking_slots.rate) As max')
                        ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where($where)->groupBy('properties.id')
                        ->havingRaw('Min(parking_slots.rate) >= ? And Max(parking_slots.rate) <= ?', [$request['min_rate'], $request['max_rate']])->get();
        }

        foreach ($slots as $slot) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $slot['id'])->get();
            $slot['picture'] = $record[0]->picture;
        }

        $data = [
            'slots' => $slots,
        ];

        if ($request['origin'] == 'homepage' || $request['origin'] == 'lease_page' || $request['origin'] == 'parking_slot_page' || $request['origin'] == 'property_page') {
            return view("pages.lease.parking_slots")->with('data', $data);
        }
        else {
            return response()->json($data);
        }
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

        $records = UnitVideo::all()->where('residential_unit_id', $request->id);
        $unit_videos = [];

        foreach ($records as $unit_video) {
            array_push($unit_videos, $unit_video['video']);
        }
        $r_unit['unit_videos'] = $unit_videos;

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
        return view('pages.lease.residential_unit')->with('data', $data);
    }

    public function commercial_unit(Request $request) {
        $c_unit = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('commercial_units.id', $request->id)->get();
        $c_unit = $c_unit[0];

        $record = Building::where('id', $c_unit['building_id'])->get();
        $c_unit['building'] = $record[0]['name'];
        $c_unit['floor_plan'] = $record[0]['floor_plan'];

        $measurements = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where('building_id', $c_unit['building_id'])->get();

        $data = [
            'c_unit' => $c_unit,
            'measurements' => $measurements,
        ];
        return view('pages.lease.commercial_unit')->with('data', $data);
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
        return view('pages.lease.parking_slot')->with('data', $data);
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

        $records = Property::selectRaw('properties.location, Count(residential_units.id) As residential_units')
                    ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $request->id)
                    ->groupByRaw('properties.location, properties.id')->get();
        count($records) > 0 ? $property['r_units'] = True : $property['r_units'] = False;

        $records = Property::selectRaw('properties.location, Count(commercial_units.id) As commercial_units')
                    ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->where('properties.id', $request->id)
                    ->groupByRaw('properties.location, properties.id')->get();
        count($records) > 0 ? $property['c_units'] = True : $property['c_units'] = False;

        $records = Property::selectRaw('properties.location, Count(parking_slots.id) As parking_slots')
                    ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where('properties.id', $request->id)
                    ->groupByRaw('properties.location, properties.id')->get();
        count($records) > 0 ? $property['p_slots'] = True : $property['p_slots'] = False;

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
        return view('pages.lease.property')->with('data', $data);
    }

    public function get_filters(Request $request) {
        $request_data = $request->all();
        $property_type = $request_data['property_type'];

        if ($property_type == 'Residential') {
            $records = Property::selectRaw('properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->groupByRaw('properties.location, properties.id')
                        ->havingRaw('Count(residential_units.id) > 0')->get();
        }
        else if ($property_type == 'Commercial') {
            $records = Property::selectRaw('properties.location, Count(commercial_units.id) As commercial_units')
                        ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->groupByRaw('properties.location, properties.id')
                        ->havingRaw('Count(commercial_units.id) > 0')->get();
        }
        else if ($property_type == 'Parking') {
            $records = Property::selectRaw('properties.location, Count(parking_slots.id) As parking_slots')
                        ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->groupByRaw('properties.location, properties.id')
                        ->havingRaw('Count(parking_slots.id) > 0')->get();
        }

        $locations = [];

        foreach ($records as $record) {
            array_push($locations, $record['location']);
        }

        $data = [
            'locations' => $locations,
        ];
        return response()->json($data);
    }

    public function get_properties(Request $request) {
        $records = Property::selectRaw('properties.name, Count(parking_slots.id) As parking_slots')
                    ->join('parking_slots', 'properties.id', '=', 'parking_slots.property_id')->where('properties.location', $request['location'])->groupByRaw('properties.name, properties.id')
                    ->havingRaw('Count(parking_slots.id) > 0')->get();

        $properties = [];

        foreach ($records as $record) {
            array_push($properties, $record['name']);
        }

        $data = [
            'properties' => $properties,
        ];
        return response()->json($data);
    }
}
