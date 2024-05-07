<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;

class BotManController extends Controller
{
    public function botman() {
        $botman = app('botman');
   
        $botman->hears('hi', function($botman) {
            $botman->reply('What are you looking for?');
        });

        $botman->hears('units', function($botman) {
            $botman->reply('For Sale or For Lease?');
        });

        $botman->hears('sale', function($botman) {
            $botman->reply('Pre-selling or RFO Units?');
        });

        $botman->hears('pre-selling', function($botman) {
            $reply = '<p>Here is a list of available units:<p>';

            $where = [
                'sale_status' => 'Pre-Selling',
                'retail_status' => 'For Sale',
                'publish_status' => 'Published',
            ];
    
            $sale_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->orderBy('properties.name')->limit(10)->get();
            foreach ($sale_units as $sale_unit) {
                $reply .= "<a href='/for-sale/category/pre-selling/$sale_unit->id' target='_blank'>$sale_unit->name - $sale_unit->unit_id</a><br>";
            }

            $botman->reply($reply);
        });

        $botman->hears('rfo', function($botman) {
            $reply = '<p>Here is a list of available units:<p>';

            $where = [
                'sale_status' => 'RFO',
                'retail_status' => 'For Sale',
                'publish_status' => 'Published',
            ];
    
            $sale_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->orderBy('properties.name')->limit(10)->get();
            foreach ($sale_units as $sale_unit) {
                $reply .= "<a href='/for-sale/category/rfo/$sale_unit->id' target='_blank'>$sale_unit->name - $sale_unit->unit_id</a><br>";
            }

            $botman->reply($reply);
        });

        $botman->hears('lease', function($botman) {
            $botman->reply('Residential or Commercial Units?');
        });

        $botman->hears('residential', function($botman) {
            $reply = '<p>Here is a list of available units:<p>';

            $where = [
                'retail_status' => 'For Lease',
                'publish_status' => 'Published',
            ];

            $r_units = Property::join('residential_units', 'properties.id', '=', 'residential_units.property_id')->where($where)->orderBy('properties.name')->limit(10)->get();
            foreach ($r_units as $r_unit) {
                $reply .= "<a href='/for-lease/category/residential_units/$r_unit->id' target='_blank'>$r_unit->name - $r_unit->unit_id</a><br>";
            }

            $botman->reply($reply);
        });

        $botman->hears('commercial', function($botman) {
            $reply = '<p>Here is a list of available units:<p>';

            $c_units = Property::join('commercial_units', 'properties.id', '=', 'commercial_units.property_id')->orderBy('properties.name')->limit(10)->get();

            foreach ($c_units as $c_unit) {
                $reply .= "<a href='/for-lease/category/commercial_units/$c_unit->id' target='_blank'>$c_unit->name - $c_unit->retail_id</a><br>";
            }

            $botman->reply($reply);
        });

        $botman->listen();
    }
}
