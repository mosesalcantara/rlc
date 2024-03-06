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
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Residential Units For You</h1>
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
                    <h3>{{ $data['r_unit']['name'] }}</h3>
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <h4>{{ $data['r_unit']['location'] }}</h4>
                </div>
                <div>
                    <h6>Unit ID: {{ $data['r_unit']['unit_id'] }}</h6>
                    <h6>Building: {{ $data['r_unit']['building'] }}</h6>

                    <div class="row details">
                        <div class="col text-center">
                            <i class="fa-solid fa-house fa-xl"></i>
                            <h6>UNIT TYPE</h6>
                            <h6 class="text-dark">{{ $data['r_unit']['type'] }}</h6>
                        </div>
                        <div class="col text-center">
                            <i class="fa-regular fa-square fa-xl"></i>
                            <h6>AREA</h6>
                            <h6 class="text-dark">{{ number_format($data['r_unit']['area'], 2) }} SQM</h6>
                        </div>
                        <div class="col text-center">
                            <i class="fa-solid fa-piggy-bank fa-xl"></i>
                            <h6>MONTHLY RATE</h6>
                            <h6 class="text-dark">PHP {{ number_format($data['r_unit']['rate'], 2) }}</h6>
                        </div>
                        <div class="col text-center">
                            <i class="fa-solid fa-key fa-xl"></i>
                            <h6>UNIT STATUS</h6>
                            <h6 class="text-dark">{{ $data['r_unit']['status'] }}</h6>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-warning">View Project Details</button>
                </div>
            </div>
            <div class="col picture text-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['r_unit']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['r_unit']['logo'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col snapshots">
                <div class="row">
                    <h1>Residential Snapshots</h1>
                </div>

                <div class="row">
                    <div class='col-1 d-flex align-items-center'>
                        <i class="fa-solid fa-circle-chevron-left fa-4x" data-bs-target="#snapshots_carousel" data-bs-slide="prev"></i>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <div id="snapshots_carousel" class="carousel slide">
                            <div class="carousel-inner">
        
                            @foreach ($data['r_unit']['snapshots'] as $snapshot)
                            <div class="carousel-item snapshot_carousel_item">
                                <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $snapshot }}" alt="">
                            </div>
                            @endforeach
        
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <i class="fa-solid fa-circle-chevron-right fa-4x" data-bs-target="#snapshots_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col amenities">
                <div class="row">
                    <h1>AMENITY GALLERY</h1>
                </div>

                <div class="row">
                    <div class='col-1 d-flex align-items-center'>
                        <i class="fa-solid fa-circle-chevron-left fa-4x" data-bs-target="#amenities_carousel" data-bs-slide="prev"></i>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <div id="amenities_carousel" class="carousel slide">
                            <div class="carousel-inner">

                            @foreach ($data['r_unit']['amenities'] as $amenity)
                            <div class="carousel-item amenity_carousel_item">
                                <div class="amenity">
                                    <img src="{{ asset('uploads/amenities/pictures') }}/{{ $amenity['picture'] }}" alt="">
                                    <div class="name">
                                        <h4>{{ $amenity['name'] }}</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
        
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <i class="fa-solid fa-circle-chevron-right fa-4x" data-bs-target="#amenities_carousel" data-bs-slide="next"></i>
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

    <script src="{{ asset('js/pages/residential_unit.js') }}"></script>
@endsection