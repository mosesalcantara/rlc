@extends('sections.pages.layout')

@section('title', 'For Sale')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/sale_units.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>{{ strtolower($data['sale_status']) == 'pre-selling' ? 'Pre-Selling Units For You' : 'RFO Units For You' }}</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col">
                <div class="row search_drops">
                    <div class="col-xxl-3">
                        <div class="dropdown" id='location'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Location</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="dropdown" id='type'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Type of Unit</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                            <ul class='dropdown-menu'>
                                <li><h6 class="dropdown-item">1BR</h6></li>
                                <li><h6 class="dropdown-item">2BR</h6></li>
                                <li><h6 class="dropdown-item">3BR</h6></li>
                                <li><h6 class="dropdown-item">PH</h6></li>
                                <li><h6 class="dropdown-item">Studio</h6></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="dropdown" id='price'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Price Range</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                            <ul class='dropdown-menu'>
                                <li><h6 class="dropdown-item">PHP 0M - 20M</h6></li>
                                <li><h6 class="dropdown-item">PHP 20M - 40M</h6></li>
                                <li><h6 class="dropdown-item">PHP 40M - 60M</h6></li>
                                <li><h6 class="dropdown-item">PHP 60M - 80M</h6></li>
                                <li><h6 class="dropdown-item">PHP 80M - 100M</h6></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-1 d-flex justify-content-center align-items-center search_btn">
                        <button class="btn btn-warning">
                            <i class="fa fa-search"></i>
                            <h6 class="d-xxl-none">Find My Unit</h6>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row units">
            @if (count($data['sale_units']) > 0)
            @foreach ($data['sale_units'] as $sale_unit)
                <div class="col-xxl-4 unit">
                    <div class="card">
                        <img class='card-img-top' src="{{ asset('uploads/residential_units/snapshots') }}/{{ $sale_unit['snapshot'] }}" alt="">
                        <div class="card-body details">
                            <h3>{{ $sale_unit['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-xl"></i>
                            <h4>{{ $sale_unit['location'] }}</h4>
                            <div class="row table">
                                <div class="col-xxl-4 col-5">
                                    <h6>Unit ID</h6>
                                    <h6>Unit Type</h6>
                                    <h6>Price</h6>
                                    <h6>Area</h6>
                                </div>
                                <div class="col-xxl col-7 text-dark">
                                    <h6>{{ $sale_unit['unit_id'] }}</h6>
                                    <h6>{{ $sale_unit['type'] }}</h6>
                                    <h6>PHP {{ $sale_unit['price'] }}M</h6>
                                    <h6>{{ $sale_unit['area'] }} SQM</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <a class="btn btn-warning" href="/for-sale/category/{{ $sale_unit['sale_status'] }}/{{ $sale_unit['id'] }}">VIEW UNIT</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="col text-center no_data">
                    No data available
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/sale_units.js') }}"></script>
@endsection