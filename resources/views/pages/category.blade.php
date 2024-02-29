@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/category.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid title_div">
        <div class="row title">
            <div class="col">
                <h1 class="title-text">Residential Units For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid search_container">
        <div class="row search_div mt-3">
            <div class="col search_drops text-center">
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

    <div class="container-fluid units">
        <div class="row">
            @if (count($data['records']) > 0)
            @foreach ($data['records'] as $record)
                <div class="col-4 unit">
                    <div class="card">
                        <div class="card-header picture text-center">
                            <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $record->picture }}" alt="">
                        </div>
                        <div class="card-body details">
                            <h3>{{ $record->name }}</h3>
                            <i class="fa-solid fa-location-dot fa-2x"></i>
                            <h4>{{ $record->location }}</h4>
                            <div class="row table">
                                <div class="col">
                                    <h6>Unit ID</h6>
                                    <h6>Unit Type</h6>
                                    <h6>Rental Rate</h6>
                                    <h6>Area</h6>
                                </div>
                                <div class="col text-dark">
                                    <h6>{{ $record->unit_id }}</h6>
                                    <h6>{{ $record->type }}</h6>
                                    <h6>PHP {{ $record->rate }} / mo</h6>
                                    <h6>{{ $record->area }} SQM</h6>
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