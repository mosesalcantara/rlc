<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SaleUnit;
use App\Models\Property;
use App\Models\Building;
use App\Models\SaleSnapshot;
use App\Models\SaleUnitVideo;

class SaleController extends Controller
{
    public function sale() {
        return view("pages.sale.index");
    }

    public function units(Request $request) {
        $sale_status = $request->sale_status;
        $where = [
            'sale_status' => '',
        ];

        $sale_status == 'pre-selling' ? $where['sale_status'] = 'Pre-Selling' : $where['sale_status'] = 'RFO';

        $sale_units = Property::join('sale_units', 'properties.id', '=', 'sale_units.property_id')->where($where)->orderBy('properties.name')->get();

        foreach ($sale_units as $sale_unit) {
            $record = SaleUnit::join('sale_snapshots', 'sale_units.id', '=', 'sale_snapshots.sale_unit_id')
                        ->where('sale_units.id', $sale_unit['id'])->get();
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

        $sale_unit = Property::join('sale_units', 'properties.id', '=', 'sale_units.property_id')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('sale_units.id', $request->id)->get();
        $sale_unit = $sale_unit[0];

        $record = Building::where('id', $sale_unit['building_id'])->get();
        $sale_unit['building'] = $record[0]['name'];

        $records = SaleSnapshot::all()->where('sale_unit_id', $request->id);
        $snapshots = [];

        foreach ($records as $snapshot) {
            array_push($snapshots, $snapshot['picture']);
        }
        $sale_unit['snapshots'] = $snapshots;

        $records = SaleUnitVideo::all()->where('sale_unit_id', $request->id);
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
        $property = Property::where('id', $request->id)->get();
        $property = $property[0];

        $records = Property::select('pictures.picture')->join('pictures', 'properties.id', '=', 'pictures.property_id')
                    ->where('properties.id', $request->id)->get();
        $pictures = [];
        foreach ($records as $record) {
            array_push($pictures, $record->picture);
        }
        $property['pictures'] = $pictures;

        $record = Property::join('sale_units', 'properties.id', '=', 'sale_units.property_id')->distinct('sale_units.type')->where('properties.id', $request->id)->get();
        $types = '';
        foreach ($record as $item) {
            $types .= ' ' . $item['type'];
        }
        $property['types'] = $types;

        $min = Property::join('sale_units', 'properties.id', '=', 'sale_units.property_id')->where('properties.id', $request->id)->min('sale_units.price');
        $property['min'] = $min;
        $max = Property::join('sale_units', 'properties.id', '=', 'sale_units.property_id')->where('properties.id', $request->id)->max('sale_units.price');
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
            ['properties.unit_types', 'LIKE', '%'.$request['unit_type'].'%'],
            ['properties.min_price', '>=', $request['min_price']],
            ['properties.max_price', '<=', $request['max_price']],
        ];

        $properties = Property::orderBy('properties.name')->where($where)->get();

        foreach ($properties as $property) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $property['id'])->get();
            $property['picture'] = $record[0]->picture;
        }

        $data = [
            'properties' => $properties,
        ];
        
        if ($request['origin'] == 'pre_selling_page' || $request['origin'] == 'rfo_page') {
            return response()->json($data);
        }
        else {
            if ($request['sale_status'] == 'Pre-Selling') {
                return view("pages.sale.pre_selling")->with('data', $data);
            }
            else if ($request['sale_status'] == 'RFO') {
                return view("pages.sale.rfo")->with('data', $data);
            }
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
