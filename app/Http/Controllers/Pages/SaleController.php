<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Building;

class SaleController extends Controller
{
    public function sale() {
        return view("pages.sale.index");
    }

    public function pre_selling(Request $request) {
        $properties = Property::orderBy('properties.name')->where('sale_status', 'Pre-Selling')->get();

        foreach ($properties as $property) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $property['id'])->get();
            $property['picture'] = $record[0]->picture;
        }

        $data = [
            'properties' => $properties,
        ];

        return view("pages.sale.pre_selling")->with('data', $data);
    }

    public function rfo(Request $request) {
        $properties = Property::orderBy('properties.name')->where('sale_status', 'RFO')->get();

        foreach ($properties as $property) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')
                        ->where('properties.id', $property['id'])->get();
            $property['picture'] = $record[0]->picture;
        }

        $data = [
            'properties' => $properties,
        ];

        return view("pages.sale.rfo")->with('data', $data);
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
