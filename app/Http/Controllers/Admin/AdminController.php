<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Property;
use App\Models\ResidentialUnit;
use App\Models\CommercialUnit;
use App\Models\ParkingSlot;

class AdminController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $counts = [];
            $counts['properties'] = Property::all()->count();
            $counts['residential_units'] = ResidentialUnit::all()->count();
            $counts['commercial_units'] = CommercialUnit::all()->count();
            $counts['parking_slots'] = ParkingSlot::all()->count();

            $data = [
                'counts' => $counts,
            ];

            return view('admin.index')->with('data', $data);
        }
        else {
            return redirect('/auth');
        }
    }
}
