<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    public function index() {
        $amenities = Amenity::all();
        
        return view('admin.amenities.index')->with('amenities', $amenities);
    }
}
