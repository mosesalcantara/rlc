<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;
use App\Mail\InquiryMail;

use App\Models\Property;
use App\Models\Amenity;
use App\Models\Video;
use App\Models\SaleUnit;
use App\Models\ResidentialUnit;
use App\Models\ContactItem;
use App\Models\InquiryEmail;
use App\Models\AboutItem;
use App\Models\Setting;

class PageController extends Controller
{
    public function get_settings() {
        $settings = Setting::all()->sortByDesc('updated_at')->take(1);
        
        $data = [
            'settings' => $settings[0],
        ];

        return response()->json($data);
    }

    public function test() {
        $amenities = Property::first();
        $amenities = $amenities->amenities;
        $data = [
            'amenities' => $amenities,
        ];
        return view('pages.test')->with('data', $data);
    }

    public function index() {
        $properties = Property::limit(5)->get();

        foreach ($properties as $property) {
            $record = Property::join('pictures', 'properties.id', '=', 'pictures.property_id')->where('properties.id', $property['id'])->limit(1)->get();
            count($record) > 0 ? $property['picture'] = $record[0]->picture : $property['picture'] = 'no_image.png';

            $record = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')
                        ->where('residential_units.property_id', $property['id'])->get();
            count($record) > 0 ? $property['snapshot'] = $record[0]->picture : $property['snapshot'] = 'no_image.png';

            $record = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->distinct('residential_units.type')->where('properties.id', $property['id'])->get();
            
            $types_arr = [];
            foreach ($record as $item) {
                array_push($types_arr, $item['type']);
            }

            $types = '';
            foreach (array_unique($types_arr) as $type) {
                $types .= ' ' . $type;
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

    public function contact() {
        $contact_items = ContactItem::all()->sortByDesc('updated_at')->take(1);

        $data = [
            'contact_items' => $contact_items[0],
        ];
        return view("pages.contact")->with('data', $data);
    }

    public function send_inquiry(Request $request) {
        $settings = Setting::all()->sortByDesc('updated_at')->take(1);

        $mailData = [
            'title' => "{$request['type']} Inquiry",
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'contact_number' => $request['contact_number'],
            'body' => $request['message'],
        ];

        Mail::to($settings[0]['email'])->send(new InquiryMail($mailData));

        $record = new InquiryEmail;

        $record->type = $request->type;
        $record->fullname = $request->fullname;
        $record->email = $request->email;
        $record->contact_number = $request->contact_number;
        $record->message = $request->message;
        $record->save();

        return redirect('/contact-us');
    }

    public function unit_registration() {
        $contact_items = ContactItem::all()->sortByDesc('updated_at')->take(1);
        $properties = Property::all();

        $data = [
            'contact_items' => $contact_items[0],
            'properties' => $properties,
        ];
        return view('pages.unit_registration')->with('data', $data);
    }

    public function register_unit(Request $request) {
        $reg_type = $request->registration_type;
        $record = $reg_type == 'For Sale' ? new SaleUnit : new ResidentialUnit;

        $record->unit_id = $request->unit_id;
        $record->type = $request->type;
        $record->area = $request->area;
        if ($reg_type == 'For Sale') { $record->price =  $request->price; }
        else { $record->rate =  $request->price; }
        $record->status = $request->status;
        $record->property_id = $request->property_id;
        $record->building_id = $request->building_id;
        $record->save();

        return response(['msg' => 'Unit Registered']);
    }

    public function related_buildings(Request $request) {
        $records = Property::join('buildings', 'properties.id', '=', 'buildings.property_id')->where('properties.id', $request->property_id)->get();

        $data = [
            'records' => $records,
        ];

        return response()->json($data);
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