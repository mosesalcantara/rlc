<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nav_item;

class PageController extends Controller
{
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

        return view("pages.category")->with('nav_items', $nav_items);
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

    public function test() {
        return view('pages.test');
    }
}
