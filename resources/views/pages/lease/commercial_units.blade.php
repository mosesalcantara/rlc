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
        <div class="row search mt-3">
            <div class="col">
                <div class="row search_drops">
                    <div class="col-xxl-5">
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
                    <div class="col-xxl-6">
                        <div class="dropdown" id='area'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Area Size</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                            <ul class='dropdown-menu'>
                                <li><h6 class="dropdown-item">10.00 - 350.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">350.00 - 700.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">700.00 - 1050.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">1050.00 - 1400.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">1400.00 - 1750.00 SQM</h6></li>
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
            @forelse ($data['c_units'] as $c_unit)
                <div class="col-xxl-4 unit">
                    <div class="card">
                        <img class='card-img-top' src="{{ asset('uploads/properties/pictures') }}/{{ $c_unit['picture'] }}" alt="">
                        <div class="card-body details">
                            <h3>{{ $c_unit['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-xl"></i>
                            <h4>{{ $c_unit['location'] }}</h4>
                            <div class="row table">
                                <div class="col-xxl-4 col-5">
                                    <h6>Retail ID</h6>
                                    <h6>Area</h6>
                                </div>
                                <div class="col-xxl col-7 text-dark">
                                    <h6>{{ $c_unit['building'] }} - {{ $c_unit['retail_id'] }}</h6>
                                    <h6>{{ $c_unit['size'] }} SQM</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <a class="btn btn-warning" href="/for-lease/category/commercial_units/{{ $c_unit['id'] }}">VIEW RETAIL</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-center no_data">
                    No data available
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/commercial_units.js') }}"></script>
@endsection