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
        <div class="row mt-3">
            <div class="col search">
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
                    <button class="btn btn-warning">View Project Details</button>
                </div>
            </div>
            <div class="col picture text-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['c_unit']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['c_unit']['logo'] }}" alt="">
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/residential_unit.js') }}"></script>
@endsection