@extends('sections.pages.layout')

@section('title', 'Residential Units')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/commercial_properties.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Commercial Properties</h1>
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
        <div class="row properties">
            @if (count($data['properties']) > 0)
            @foreach ($data['properties'] as $property)
                <div class="col-xxl-4 property">
                    <div class="card">
                        <img class='card-img-top' src="{{ asset('uploads/properties/pictures') }}/{{ $property['picture'] }}" alt="">
                        <div class="card-body details">
                            <h3>{{ $property['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-xl"></i>
                            <h4>{{ $property['location'] }}</h4>
                            <div class="row table">
                                <div class="col-xxl-4 col-5">
                                    <h6>Area</h6>
                                </div>
                                <div class="col-xxl col-7 text-dark">
                                    <h6>{{ number_format($property['min_area'], 2) }} - {{ number_format($property['max_area'], 2) }} SQM</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <a class="btn btn-warning view_units_btn" data-property_id='{{ $property['id'] }}'>VIEW UNITS</a>
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

        <form action="" method="POST" class="d-none" id='search_form'>
            @csrf
            <input type="hidden" name='location' value=''>
            <input type="hidden" name='min_area' value=''>
            <input type="hidden" name='max_area' value=''>
            <input type="hidden" name='origin' value='commercial_properties_search'>
        </form>

        <form action="" method="POST" class="d-none" id='view_units_form'>
            @csrf
            <input type="hidden" name='property_id' value=''>
            <input type="hidden" name='origin' value='commercial_properties_view_units'>
        </form>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/commercial_properties.js') }}"></script>
@endsection