<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Building;
use App\Models\ResidentialUnit;
use App\Models\Snapshot;

class CompareController extends Controller
{
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
}
