<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Video;
use App\Models\ResidentialUnit;
use App\Models\Snapshot;
use App\Models\ContactItem;
use App\Models\AboutItem;

class PageController extends Controller
{

    public function test() {
        return view("pages.test");
    }

    public function index() {
        $properties = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->limit(5)->get();

        foreach ($properties as $property) {
            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.property_id', $property['property_id'])->get();
            $property['snapshot'] = $record[0]->picture;

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.id', $property['property_id'])->get();
            $types = '';
            foreach ($record as $item) {
                $types .= ' ' . $item['type'];
            }
            $property['types'] = $types;

            $min = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $property['property_id'])->min('residential_units.rate');
            $property['min'] = $min;
            $max = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where('properties.id', $property['property_id'])->max('residential_units.rate');
            $property['max'] = $max;
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


        $records = Snapshot::all()->where('residential_unit_id', $request->id);
        $snapshots = [];
        
        foreach ($records as $snapshot) {
            array_push($snapshots, $snapshot['picture']);
        }
        $r_unit['snapshots'] = $snapshots;

        $data = [
            'r_unit' => $r_unit,
        ];
        return view('pages.residential_unit')->with('data', $data);
    }

    public function properties() {
        return view("pages.properties");
    }

    public function contact() {
        $contact_items = ContactItem::all()->sortByDesc('updated_at')->take(1);

        $data = [
            'contact_items' => $contact_items[0],
        ];
        return view("pages.contact")->with('data', $data);
    }

    public function about() {
        $articles = AboutItem::join('articles', 'about_items.id', '=', 'articles.about_item_id')->orderBy('about_items.id')->limit(3)->get();
    
        $data = [
            'articles' => $articles,
        ];
        return view("pages.about")->with('data', $data);
    }
}
