@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/commercial_unit.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Commercial Units For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col text-center search">
                <div class="row">
                    <div class="col">
                        <select name="" id="" class="form-select">
                            <option value="" selected>Property Type</option>
                            <option value="">Residential</option>
                            <option value="">Commercial</option>
                            <option value="">Parking</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="" id="" class="form-select">
                            <option value="" selected>Location</option>
                            <option value="">Mandaluyong City</option>
                            <option value="">Muntinlupa City</option>
                            <option value="">Quezon City</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="" id="" class="form-select">
                            <option value="" selected>Type of Unit</option>
                            <option value="">1 BR</option>
                            <option value="">2 BR</option>
                            <option value="">3 BR</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="" id="" class="form-select">
                            <option value="" selected>Rental Rate</option>
                            <option value="">PHP 0.00 - 16,000.00</option>
                            <option value="">PHP 16,000.00 - 32,000.00</option>
                            <option value="">PHP 32,000.00 - 48,000.00</option>
                        </select>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <button class="btn btn-warning">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row unit">
            <div class="col info">
                <div class="top">
                    <h3>{{ $data['c_unit']['name'] }}</h3>
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <h4>{{ $data['c_unit']['location'] }}</h4>
                </div>
                <div>
                    <h6>Retail ID: {{ $data['c_unit']['retail_id'] }}</h6>
                    <h6>Building: {{ $data['c_unit']['building'] }}</h6>
                    <h6>Size: {{ $data['c_unit']['size'] }}</h6>
                </div>
                <div class="text-center">
                    <a class="btn btn-warning" href='/for-lease/property/{{ $data['c_unit']['property_id'] }}'>View Project Details</a>
                </div>
            </div>
            <div class="col picture text-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['c_unit']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['c_unit']['logo'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col floor_plan">
                <div class="row">
                    <h1>Floor Plan</h1>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-center">
                            <img src="{{ asset('uploads/buildings/floor_plans/') }}/{{ $data['c_unit']['floor_plan'] }}" alt="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row d-flex justify-content-center text-center tbl_measurements">
                            <table class="table table-sm">
                                <tbody>
                                    @foreach ($data['measurements'] as $measurement)
                                    <tr>
                                        <td><h6>{{ $measurement['retail_id'] }}</h6></td>
                                        <td><h6>{{ $measurement['size'] }} sqm</h6></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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