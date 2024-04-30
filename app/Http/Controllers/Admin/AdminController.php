<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Property;
use App\Models\ResidentialUnit;
use App\Models\CommercialUnit;
use App\Models\ParkingSlot;
use App\Models\InquiryEmail;
use App\Models\Viewing;
use App\Models\RegisteredUnit;

class AdminController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $counts = [];
            $counts['properties'] = Property::all()->count();
            $counts['residential_units'] = ResidentialUnit::all()->count();
            $counts['commercial_units'] = CommercialUnit::all()->count();
            $counts['parking_slots'] = ParkingSlot::all()->count();
            $counts['inquiries'] = InquiryEmail::all()->count();
            $counts['viewings'] = Viewing::all()->count();
            $counts['registered_units'] = RegisteredUnit::all()->count();

            $sale = ResidentialUnit::all()->where('retail_status', 'For Sale')->count();
            $lease = ResidentialUnit::all()->where('retail_status', 'For Lease')->count();
            $retail_status = [
                'sale' => $sale,
                'lease' => $lease,
            ];

            $for_lease = [
                'residential_units' => $counts['residential_units'],
                'commercial_units' => $counts['commercial_units'],
                'parking_slots' => $counts['parking_slots'],
            ];

            $amenities_property = Property::selectRaw('properties.id, properties.name, (Select Count(id) from Amenities Where property_id = properties.id) As amenities')->get();

            $reviews_property = Property::selectRaw('properties.id, properties.name, (Select Count(id) from Reviews Where property_id = properties.id) As reviews')->get();

            $data = [
                'counts' => $counts,
                'retail_status' => $retail_status,
                'for_lease' => $for_lease,
                'amenities_property' => $amenities_property,
                'reviews_property' => $reviews_property,
            ];

            return view('admin.index')->with('data', $data);
        }
        else {
            return redirect('/auth');
        }
    }
}
