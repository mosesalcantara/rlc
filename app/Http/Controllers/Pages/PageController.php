<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;
use App\Mail\InquiryMail;

use App\Models\Property;
use App\Models\Building;
use App\Models\Video;
use App\Models\ResidentialUnit;
use App\Models\Snapshot;
use App\Models\ContactItem;
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
        return view('pages.test');
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
            'title' => "{$request['inquiry_type']} Inquiry",
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'number' => $request['number'],
            'body' => $request['message'],
        ];

        Mail::to($settings[0]['email'])->send(new InquiryMail($mailData));

        return redirect('/contact-us');
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