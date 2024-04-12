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

    public function units(Request $request) {
        $sale_status = $request->sale_status;
        $where = [
            'sale_status' => '',
            'retail_status' => 'For Sale',
        ];

        $sale_status == 'pre-selling' ? $where['sale_status'] = 'Pre-Selling' : $where['sale_status'] = 'RFO';

        $sale_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->orderBy('properties.name')->get();

        foreach ($sale_units as $sale_unit) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.id', $sale_unit['id'])->get();
            $sale_unit['snapshot'] = $record[0]->picture;
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
            'published' => 1,
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
        $property['min'] = $min;
        $max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->max('residential_units.price');
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
        return view('pages.sale.sale_property')->with('data', $data);
    }

    public function search(Request $request) {
        $where = [
            ['properties.sale_status', $request['sale_status']],
            ['properties.location', $request['location']],
            ['residential_units.type', $request['type']],
            ['residential_units.price', '>=', $request['min_price']],
            ['residential_units.price', '<=', $request['max_price']],
            ['residential_units.retail_status', 'For Sale'],
            ['residential_units.published', 1],
        ];

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

        $records = Property::select('location')->distinct('location')->where('sale_status', $sale_status)->get();

        $data = [
            'records' => $records,
        ];
        return response()->json($data);
    }
}
