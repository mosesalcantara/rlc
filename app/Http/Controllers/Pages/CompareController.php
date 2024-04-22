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
        $where = [
            'retail_status' => 'For Lease',
            'publish_status' => 'Published',
        ];
        $records = Property::selectRaw('properties.name, properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)
                        ->groupByRaw('properties.name, properties.location')->havingRaw('Count(residential_units.id) > 0')->get();
        $locations = Property::selectRaw('properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)
                        ->groupByRaw('properties.location, properties.id')->havingRaw('Count(residential_units.id) > 0')->get();
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
                    ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->groupByRaw('properties.id, properties.name, properties.location')
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
            $where = [
                'properties.name' => $property,
                'retail_status' => 'For Lease',
                'publish_status' => 'Published',
            ];
            $details = [];

            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.name', $property)->get();
            count($record) > 0 ? $details['picture'] = $record[0]['picture'] : $details['picture'] = 'no_image.png';
            $details['id'] = $record[0]['property_id'];
            $details['location'] = $record[0]['location'];
            $details['name'] = $property;

            $property_types = '';
            $record = Property::selectRaw('properties.name, properties.location, Count(residential_units.id) As residential_units')
                        ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')
                        ->where('retail_status', 'For Lease')->where('publish_status', 'Published')
                        ->groupByRaw('properties.name, properties.location')->havingRaw('Count(residential_units.id) > 0')->get();
            if ($record[0]['residential_units'] > 0) {
                $property_types .= ' Residential';
            }

            $record = Property::selectRaw('properties.name, properties.location, Count(commercial_units.id) As commercial_units')
                        ->join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->groupByRaw('properties.name, properties.location')->havingRaw('Count(commercial_units.id) > 0')->get();
            if ($record[0]['commercial_units'] > 0) {
                $property_types .= ' Commercial';
            }

            $details['property_types'] = $property_types;

            $details['min_price'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->min('residential_units.price');
            $details['max_price'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->max('residential_units.price');

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where($where)->get();

            $types_arr = [];
            foreach ($record as $item) {
                array_push($types_arr, $item['type']);
            }

            $types = '';
            foreach (array_unique($types_arr) as $type) {
                $types .= ' ' . $type;
            }
            $details['types'] = $types;

            $details['min_area'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->min('residential_units.area');
            $details['max_area'] = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->max('residential_units.area');

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.status')->where($where)->get();
            $statuses_arr = [];
            foreach ($record as $item) {
                array_push($statuses_arr, $item['status']);
            }

            $statuses = '';
            foreach (array_unique($statuses_arr) as $status) {
                $statuses .= ' ' . $status;
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
            count($record) > 0 ? $details['picture'] = $record[0]['picture'] : $details['picture'] = 'no_image.png';
            $details['id'] = $record[0]['property_id'];
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
                ['residential_units.price', '>=', $request_data['min_price']],
                ['residential_units.price', '<=', $request_data['max_price']],
                ['residential_units.area', '>=', $request_data['min_area']],
                ['residential_units.area', '<=', $request_data['max_area']],
                ['properties.name', $property],
                ['residential_units.retail_status', 'For Lease'],
                ['residential_units.publish_status', 'Published'],
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
                count($snapshot) > 0 ? $record['snapshot'] = $snapshot[0]->picture : $record['snapshot'] = 'no_image.png';
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
                count($picture) > 0 ? $record['picture'] = $picture[0]->picture : $record['picture'] = 'no_image.png';

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
