@extends('sections.pages.layout')

@section('title', 'Parking Slots')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/parking_slots.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Parking Slots For You</h1>
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
            @if (count($data['slots']) > 0)
            @foreach ($data['slots'] as $slot)
                <div class="col-lg-4 unit">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('uploads/properties/pictures') }}/{{ $slot['picture'] }}" alt="">
                        <div class="card-body details">
                            <h3>{{ $slot['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-2x"></i>
                            <h4>{{ $slot['location'] }}</h4>
                            <div class="row table">
                                <div class="col">
                                    <h6>Rate</h6>
                                </div>
                                <div class="col text-dark">
                                    <h6>PHP {{ number_format($slot['min'], 2) }} - {{ number_format($slot['max'], 2) }} / mo</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <a class="btn btn-warning" href="/for-lease/category/parking_slots/{{ $slot['id'] }}">View Details</a>
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