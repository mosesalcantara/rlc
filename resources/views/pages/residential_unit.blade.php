@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/residential_unit.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid title_div">
        <div class="row">
            <div class="col title">
                <h1>Residential Units For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid search_container">
        <div class="row mt-3">
            <div class="col search text-center">
                <select name="" id="" class="form-select">
                    <option value="" selected>Property Type</option>
                    <option value="">Residential</option>
                    <option value="">Commercial</option>
                    <option value="">Parking</option>
                </select>
                <select name="" id="" class="form-select">
                    <option value="" selected>Location</option>
                    <option value="">Mandaluyong City</option>
                    <option value="">Muntinlupa City</option>
                    <option value="">Quezon City</option>
                </select>
                <select name="" id="" class="form-select">
                    <option value="" selected>Type of Unit</option>
                    <option value="">1 BR</option>
                    <option value="">2 BR</option>
                    <option value="">3 BR</option>
                </select>
                <select name="" id="" class="form-select">
                    <option value="" selected>Rental Rate</option>
                    <option value="">PHP 0.00 - 16,000.00</option>
                    <option value="">PHP 16,000.00 - 32,000.00</option>
                    <option value="">PHP 32,000.00 - 48,000.00</option>
                </select>
                <button class="btn btn-warning">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row unit">
            <div class="col details">
                <h3>Axis Residences</h3>
                <i class="fa-solid fa-location-dot fa-2x"></i>
                <h4>Mandaluyong City</h4>
                <div>
                    <h6>Unit ID: AXR01</h6>
                    <h6>Building: Tower A</h6>
                    <h6>Unit Type: Studio</h6>
                    <h6>Monthly Rate:PHP 25,000.00</h6>
                    <h6>Unit Status: Fully Furnished</h6>
                </div>
                <div class="text-center">
                    <button class="btn btn-warning">View Project Details</button>
                </div>
            </div>
            <div class="col">
                <img src="{{ asset('uploads/properties/pictures/1709259926.jpg') }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col snapshots">
                <h1>Residential Snapshots</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col amenities">
                <h1>Amenity Gallery</h1>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent
@endsection