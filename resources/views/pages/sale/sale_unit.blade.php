@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/sale_unit.css') }}">
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

        <form action="/for-sale/search" method="POST" class="d-none" id='search_form'>
            @csrf
            <input type="hidden" name='sale_status' value=''>
            <input type="hidden" name='location' value=''>
            <input type="hidden" name='type' value=''>
            <input type="hidden" name='min_price' value=''>
            <input type="hidden" name='max_price' value=''>
            <input type="hidden" name='origin' value='sale_unit_page'>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row unit">
            <div class="col info order-xxl-first order-last">
                <div class="top">
                    <h3>{{ $data['sale_unit']['name'] }}</h3>
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <h4>{{ $data['sale_unit']['location'] }}</h4>
                </div>
                <div>
                    <h6>Unit ID: {{ $data['sale_unit']['unit_id'] }}</h6>
                    <h6>Building: {{ $data['sale_unit']['building'] }}</h6>

                    <div class="row details">
                        <div class="col-5 col-xxl text-center">
                            <i class="fa-solid fa-house fa-xl"></i>
                            <h6>UNIT TYPE</h6>
                            <h6 class="text-dark">{{ $data['sale_unit']['type'] }}</h6>
                        </div>
                        <div class="col-5 col-xxl text-center">
                            <i class="fa-regular fa-square fa-xl"></i>
                            <h6>AREA</h6>
                            <h6 class="text-dark">{{ number_format($data['sale_unit']['area'], 2) }} SQM</h6>
                        </div>
                        <div class="col-5 col-xxl text-center">
                            <i class="fa-solid fa-piggy-bank fa-xl fa-flip-vertical"></i>
                            <h6>MONTHLY RATE</h6>
                            <h6 class="text-dark">PHP {{ $data['sale_unit']['price'] }}M</h6>
                        </div>
                        <div class="col-5 col-xxl text-center">
                            <i class="fa-solid fa-key fa-xl"></i>
                            <h6>UNIT STATUS</h6>
                            <h6 class="text-dark">{{ $data['sale_unit']['status'] }}</h6>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="btn btn-warning" data-bs-target="#viewingModal" data-bs-toggle="modal">Request a Viewing</a>
                    <a class="btn btn-warning" href='/for-sale/property/{{ $data['sale_unit']['property_id'] }}'>View Project Details</a>
                </div>
            </div>
            <div class="col-12 col-xxl picture text-end order-xxl-last order-first" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['sale_unit']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['sale_unit']['logo'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col snapshots">
                <div class="row">
                    <h1 class="text-center text-xxl-start">Residential Snapshots</h1>
                </div>

                <div class="row">
                    <div class='col-1 d-flex align-items-center'>
                        <i class="fa-solid fa-circle-chevron-left" data-bs-target="#snapshots_carousel" data-bs-slide="prev"></i>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <div id="snapshots_carousel" class="carousel slide">
                            <div class="carousel-inner">
        
                            @foreach ($data['sale_unit']['snapshots'] as $snapshot)
                            <div class="carousel-item snapshot_carousel_item">
                                <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $snapshot }}" alt="">
                            </div>
                            @endforeach
        
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <i class="fa-solid fa-circle-chevron-right" data-bs-target="#snapshots_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col unit_videos">
                <div class="row">
                    <h1 class="text-center text-xxl-start">Unit Videos</h1>
                </div>

                <div class="row">
                    <div class='col-1 d-flex align-items-center'>
                        <i class="fa-solid fa-circle-chevron-left" data-bs-target="#unit_videos_carousel" data-bs-slide="prev"></i>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <div id="unit_videos_carousel" class="carousel slide">
                            <div class="carousel-inner">
        
                            @foreach ($data['sale_unit']['unit_videos'] as $unit_video)
                            <div class="carousel-item unit_video_carousel_item">
                                <video controls>
                                    <source src="{{ asset('uploads/residential_units/unit_videos') }}/{{ $unit_video }}">
                                </video>
                            </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <i class="fa-solid fa-circle-chevron-right" data-bs-target="#unit_videos_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col amenities">
                <div class="row">
                    <h1 class="text-center text-xxl-start">AMENITY GALLERY</h1>
                </div>

                <div class="row">
                    <div class='col-1 d-flex align-items-center'>
                        <i class="fa-solid fa-circle-chevron-left fa-4x" data-bs-target="#amenities_carousel" data-bs-slide="prev"></i>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <div id="amenities_carousel" class="carousel slide">
                            <div class="carousel-inner">

                            @foreach ($data['sale_unit']['amenities'] as $amenity)
                            <div class="carousel-item amenity_carousel_item">
                                <div class="amenity">
                                    <img src="{{ asset('uploads/amenities/pictures') }}/{{ $amenity['picture'] }}" alt="">
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

    <div class="modal" tabindex="-1" id="viewingModal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Request a Viewing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/request-viewing" method="post" enctype="multipart/form-data" id="viewingForm">    
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control">
                                <label for="">Full Name</label>     
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control">
                        <label for="">Email</label>     
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="phone" class="form-control">
                                <label for="">Contact Number</label>     
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="date" class="form-control">
                                <label for="">Viewing Date</label>     
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="time" name="time" class="form-control">
                                <label for="">Viewing Time</label>     
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Message</label>     
                        <textarea class="form-control" name="message" cols="30" rows="5"></textarea>
                    </div>

                    <input type="hidden" name='id' value='{{ $data['sale_unit']['id'] }}'>
            </div>
            <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

    <script src="{{ asset('js/pages/sale_unit.js') }}"></script>
@endsection