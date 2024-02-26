<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResidentialUnit;

class ResidentialUnitController extends Controller
{
    public function index() {
        $r_units = ResidentialUnit::all();
        
        return view('admin.reidential_units.index')->with('r_units', $r_units);
    }
}
