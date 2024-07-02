<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ResidentialUnit;
use App\Models\Property;
use App\Models\Building;
use App\Models\Snapshot;
use App\Models\UnitVideo;

class SaleController extends Controller
{
    public function sale() {
        return view("pages.sale.index");
    }

    public function properties(Request $request) {
        $sale_status = $request->sale_status;
        $sale_status == 'pre-selling' ? $sale_status = 'Pre-Selling' : $sale_status = 'RFO';

        $records = Property::selectRaw('properties.id, properties.name, properties.location, Count(residential_units.id) As residential_units')
                    ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')
                    ->where('sale_status', $sale_status)->where('retail_status', 'For Sale')->where('publish_status', 'Published')
                    ->groupByRaw('properties.id, properties.name, properties.location')->havingRaw('Count(residential_units.id) > 0')->get();

        $properties = [];

        foreach ($records as $property) {
            $details = [];
            $where = [
                'sale_status' => $sale_status,
                'retail_status' => 'For Sale',
                'publish_status' => 'Published',
                'properties.id' => $property['id'],
            ];

            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $property['id'])->get();
            count($record) > 0 ? $details['picture'] = $record[0]['picture'] : $details['picture'] = 'no_image.png';
            $details['id'] = $record[0]['property_id'];
            $details['name'] = $record[0]['name'];
            $details['location'] = $record[0]['location'];

            $min_price = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->min('residential_units.price');
            $max_price = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->max('residential_units.price');

            if ($min_price == $max_price) {
                $details['price'] = "PHP $min_price"."M";
            }
            else {
                $details['price'] = "PHP $min_price"."M"." - $max_price"."M";
            }

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

            $min_area = number_format(Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->min('residential_units.area'), 2);
            $max_area = number_format(Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->max('residential_units.area'), 2);

            if ($min_area == $max_area) {
                $details['area'] = "$min_area SQM";
            }
            else {
                $details['area'] = "$min_area - $max_area SQM";
            }

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
            'sale_status' => $sale_status,
        ];
        return view("pages.sale.properties")->with('data', $data);
    }

    public function units(Request $request) {
        $sale_status = $request->sale_status;
        $where = [
            'sale_status' => '',
            'retail_status' => 'For Sale',
            'publish_status' => 'Published',
        ];

        $sale_status == 'pre-selling' ? $where['sale_status'] = 'Pre-Selling' : $where['sale_status'] = 'RFO';

        $sale_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->orderBy('properties.name')->get();

        foreach ($sale_units as $sale_unit) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $sale_unit['id'])->get();
            count($record) > 0 ? $sale_unit['snapshot'] = $record[0]->picture : $sale_unit['snapshot'] = 'no_image.png';
        }

        $data = [
            'sale_units' => $sale_units,
            'sale_status' => $sale_status,
        ];
        
        return view("pages.sale.sale_units")->with('data', $data);
    }

    public function unit(Request $request) {
        $sale_status = $request->sale_status;

        $sale_unit = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('residential_units.id', $request->id)->get();
        $sale_unit = $sale_unit[0];
        $sale_unit['id'] = $request->id;

        $record = Building::where('id', $sale_unit['building_id'])->get();
        $sale_unit['building'] = $record[0]['name'];

        $records = Snapshot::all()->where('residential_unit_id', $request->id);
        $snapshots = [];

        foreach ($records as $snapshot) {
            array_push($snapshots, $snapshot['picture']);
        }
        $sale_unit['snapshots'] = $snapshots;

        $records = UnitVideo::all()->where('residential_unit_id', $request->id);
        $unit_videos = [];

        foreach ($records as $unit_video) {
            array_push($unit_videos, $unit_video['video']);
        }
        $sale_unit['unit_videos'] = $unit_videos;

        $records = Property::select('amenities.id', 'amenities.name', 'amenities.type', 'amenities.picture')
                    ->join('amenities', 'properties.id', '=', 'amenities.property_id')->where('properties.id', $sale_unit['property_id'])->get();
        $amenities = [];

        foreach ($records as $amenity) {
            array_push($amenities, $amenity);
        }
        $sale_unit['amenities'] = $amenities;

        $data = [
            'sale_unit' => $sale_unit,
            'sale_status' => $sale_status,
        ];
        return view('pages.sale.sale_unit')->with('data', $data);
    }

    public function property(Request $request) {
        $where = [
            'properties.id' => $request->id,
            'retail_status' => 'For Sale',
            'publish_status' => 'Published',
        ];

        $property = Property::where('id', $request->id)->get();
        $property = $property[0];

        $records = Property::select('pictures.picture')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('properties.id', $request->id)->get();
        $pictures = [];
        foreach ($records as $record) {
            array_push($pictures, $record->picture);
        }
        $property['pictures'] = $pictures;

        $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where($where)->get();
        $types = '';
        foreach ($record as $item) {
            $types .= ' ' . $item['type'];
        }
        $property['types'] = $types;

        $min = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->min('residential_units.price');
        $max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->max('residential_units.price');

        if ($min == $max) {
            $property['price'] = "PHP $min"."M";
        }
        else {
            $property['price'] = "PHP $min"."M"." - $max"."M";
        }

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
        return view('pages.sale.sale_property')->with('data', $data);
    }

    public function search(Request $request) {
        if ($request['origin'] == 'sale_properties_view_units') {
            $where = [
                ['properties.id', $request['property_id']],
                ['properties.sale_status', $request['sale_status']],
                ['residential_units.retail_status', 'For Sale'],
                ['residential_units.publish_status', 'Published'],
            ];
        }
        else {
            $where = [
                ['properties.sale_status', $request['sale_status']],
                ['properties.location', $request['location']],
                ['residential_units.type', $request['type']],
                ['residential_units.price', '>=', $request['min_price']],
                ['residential_units.price', '<=', $request['max_price']],
                ['residential_units.retail_status', 'For Sale'],
                ['residential_units.publish_status', 'Published'],
            ];
        }

        $sale_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->get();

        foreach ($sale_units as $sale_unit) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $sale_unit['id'])->get();
            $sale_unit['snapshot'] = $record[0]->picture;
        }

        $data = [
            'sale_units' => $sale_units,
            'sale_status' => $request['sale_status'],
        ];
        
        if ($request['origin'] == 'sale_units_page') {
            return response()->json($data);
        }
        else {
            return view("pages.sale.sale_units")->with('data', $data);
        }
    }

    public function get_filters(Request $request) {
        $request_data = $request->all();
        $sale_status = $request_data['sale_status'];

        $where = [
            ['properties.sale_status', $sale_status],
            ['residential_units.retail_status', 'For Sale'],
            ['residential_units.publish_status', 'Published'],
        ];

        $records = Property::selectRaw('properties.location, Count(residential_units.id) As residential_units')
                    ->join('residential_units', 'properties.id', '=', 'residential_units.property_id')    
                    ->groupByRaw('properties.location, properties.id')->where($where)
                    ->havingRaw('Count(residential_units.id) > 0')->get();

        $locations = [];
        foreach ($records as $record) {
            array_push($locations, $record['location']);
        }
        $locations = array_unique($locations);

        $data = [
            'locations' => $locations,
        ];
        return response()->json($data);
    }
}
