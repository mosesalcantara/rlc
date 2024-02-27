<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Nav_item;
use App\Models\ResidentialUnit;
use App\Models\Property;

class PageController extends Controller
{

    public function test() {
        $snapshots = ResidentialUnit::join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->get();
        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->get();
        // foreach ($r_units as $r_unit) {
        //     $r_unit['picture'] = '1708999227.jpg';
        // }

        $data = [
            'snapshots' => $snapshots,
            'r_units' => $r_units,
        ];

        return view("pages.test")->with('data', $data);
        // return view("pages.test")->with('r_units', $r_units);
    }

    public function index() {
        $nav_items = Nav_item::all()->sortBy('order');

        foreach ($nav_items as $nav_item) {
            $link = $nav_item->title;
            $link = strtolower($link);

            if ($link == 'home') {
                $link = '';
            }
            else {
                $link = str_replace(' ', '-', $link);
            }

            $nav_item['link'] = $link;
        }

        return view("pages.index")->with('nav_items', $nav_items);
    }

    public function lease() {
        $nav_items = Nav_item::all()->sortBy('order');

        foreach ($nav_items as $nav_item) {
            $link = $nav_item->title;
            $link = strtolower($link);

            if ($link == 'home') {
                $link = '';
            }
            else {
                $link = str_replace(' ', '-', $link);
            }

            $nav_item['link'] = $link;
        }

        return view("pages.lease")->with('nav_items', $nav_items);
    }

    public function category(Request $request) {
        $nav_items = Nav_item::all()->sortBy('order');

        foreach ($nav_items as $nav_item) {
            $link = $nav_item->title;
            $link = strtolower($link);

            if ($link == 'home') {
                $link = '';
            }
            else {
                $link = str_replace(' ', '-', $link);
            }

            $nav_item['link'] = $link;
        }

        $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->join('snapshots', 'residential_units.id', '=', 'snapshots.residential_unit_id')->get();

        $data = [
            'nav_items' => $nav_items,
            'r_units' => $r_units,
        ];

        return view("pages.category")->with('data', $data);
    }

    public function unit() {
        return view('pages.unit');
    }

    public function properties() {
        $nav_items = Nav_item::all()->sortBy('order');

        foreach ($nav_items as $nav_item) {
            $link = $nav_item->title;
            $link = strtolower($link);

            if ($link == 'home') {
                $link = '';
            }
            else {
                $link = str_replace(' ', '-', $link);
            }

            $nav_item['link'] = $link;
        }

        return view("pages.properties")->with('nav_items', $nav_items);
    }

    public function contact() {
        $nav_items = Nav_item::all()->sortBy('order');

        foreach ($nav_items as $nav_item) {
            $link = $nav_item->title;
            $link = strtolower($link);

            if ($link == 'home') {
                $link = '';
            }
            else {
                $link = str_replace(' ', '-', $link);
            }

            $nav_item['link'] = $link;
        }

        return view("pages.contact")->with('nav_items', $nav_items);
    }

    public function about() {
        $nav_items = Nav_item::all()->sortBy('order');

        foreach ($nav_items as $nav_item) {
            $link = $nav_item->title;
            $link = strtolower($link);

            if ($link == 'home') {
                $link = '';
            }
            else {
                $link = str_replace(' ', '-', $link);
            }

            $nav_item['link'] = $link;
        }

        return view("pages.about")->with('nav_items', $nav_items);
    }
}
