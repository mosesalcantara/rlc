@extends('sections.pages.layout')

@section('title', 'Commercial Units')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/commercial_units.css') }}">
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

    <div class="container-fluid">
        <div class="row units">
            @if (count($data['c_units']) > 0)
            @foreach ($data['c_units'] as $c_unit)
                <div class="col-lg-4 unit">
                    <div class="card">
                        <div class="card-header picture text-center">
                            <img src="{{ asset('uploads/properties/pictures') }}/{{ $c_unit['picture'] }}" alt="">
                        </div>
                        <div class="card-body details">
                            <h3>{{ $c_unit['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-2x"></i>
                            <h4>{{ $c_unit['location'] }}</h4>
                            <div class="row table">
                                <div class="col">
                                    <h6>Retail ID</h6>
                                    <h6>Area</h6>
                                </div>
                                <div class="col text-dark">
                                    <h6>{{ $c_unit['building'] }} - {{ $c_unit['retail_id'] }}</h6>
                                    <h6>{{ $c_unit['size'] }} SQM</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent
@endsection