@extends('sections.pages.layout')

@section('title', 'Home')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/index.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid" style="background-image: url({{ asset('img/pages/home/header-bg.png') }})">
        <div class="row gx-0 header d-xxl-flex d-none" style="background-image: url({{ asset('img/pages/home/shape.png') }})">
            
        </div>

        <div class="row header_carousel_div">
            <div class="col d-xxl-none ">
                <div id="header_carousel" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('img/pages/home/header-1.jpg') }}" class="d-block w-100" alt=" ">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('img/pages/home/header-2.jpg') }}" class="d-block w-100" alt=" ">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('img/pages/home/header-3.jpg') }}" class="d-block w-100" alt="">
                      </div>
                    </div>
    
                    <button class="carousel-control-prev" type="button" data-bs-target="#header_carousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    
                    <button class="carousel-control-next" type="button" data-bs-target="#header_carousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col">
                <div class="row search_drops">
                    <div class="col-xxl-3">
                        <div class="dropdown" id='property_type'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Property Type</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                            <ul class='dropdown-menu'>
                                <li><h6 class="dropdown-item">Residential</h6></li>
                                <li><h6 class="dropdown-item">Commercial</h6></li>
                                <li><h6 class="dropdown-item">Parking</h6></li>
                            </ul>
                        </div>
                    </div>
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
                    <div class="col-xxl-2">
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
                    <div class="col-xxl-3">
                        <div class="dropdown" id='price'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Rental Rate</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                            <ul class='dropdown-menu'>
                                <li><h6 class="dropdown-item">PHP 0.00 - 16,000.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 16,000.00 - 32,000.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 32,000.00 - 48,000.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 48,000.00 - 64,000.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 64,000.00 - 80,000.00</h6></li>
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

        <form action="" method="POST" class="d-none" id='search_form'>
            @csrf
            <input type="hidden" name='property_type' value=''>
            <input type="hidden" name='location' value=''>
            <input type="hidden" name='type' value=''>
            <input type="hidden" name='min_price' value=''>
            <input type="hidden" name='max_price' value=''>
            <input type="hidden" name='origin' value='homepage'>
        </form>
    </div>

    <div class="container-fluid featured">
        <div class="row">
            <div class="col-xxl-6 d-xxl-flex align-items-center justify-content-xxl-start">        
                <h1>Our Featured Properties</h1>
            </div>
            <div class="col-xxl-6 d-xxl-flex align-items-center justify-content-xxl-end">
                <h4>Explored our wide selection of projects to know more.</h4>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div id="properties_carousel" class="carousel slide">
                    <div class="carousel-inner">

                    @foreach ($data['properties'] as $property)
                    <div class="carousel-item property_carousel_item">
                        <div class="card_front container-fluid">
                            <div class="d-flex justify-content-center align-items-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $property['picture'] }})">
                                <i class="fa-solid fa-circle-chevron-right front_switch"></i>
                            </div>
                        </div>

                        <div class="card_back container-fluid d-none">
                            <div class="row">

                                <div class="col snapshot">
                                    <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $property['snapshot'] }}" alt="">
                                </div>

                                <div class='col info'>
                                    <div class="d-flex justify-content-end">
                                        <i class="fa-solid fa-circle-chevron-left back_switch text-info"></i>
                                    </div>

                                    <h4>{{ $property['name'] }}</h4>
                                    <p>{{ $property['description'] }}</p>

                                    <div class='details'>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <h5>{{ $property['location'] }}</h5>
                                        <span class="br"></span>
                                        <i class="fa-solid fa-building"></i>
                                        <h5>{{ $property['types'] }}</h5>
                                        <span class="br"></span>
                                        <i class="fa-solid fa-user"></i>
                                        <h5>PHP {{ number_format($property['min'], 2) }} - {{ number_format($property['max'], 2) }} / mo</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mobile_card_back container-fluid d-none">
                            <div class="row">
                                <div class='col info'>
                                    <div class="d-flex justify-content-end">
                                        <i class="fa-solid fa-circle-chevron-left back_switch text-info"></i>
                                    </div>

                                    <h4>{{ $property['name'] }}</h4>
                                    <p>{{ $property['description'] }}</p>

                                    <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $property['snapshot'] }}" alt="">

                                    <div class='details'>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <h5>{{ $property['location'] }}</h5>
                                        <span class="br"></span>
                                        <i class="fa-solid fa-building"></i>
                                        <h5>{{ $property['types'] }}</h5>
                                        <span class="br"></span>
                                        <i class="fa-solid fa-user"></i>
                                        <h5>PHP {{ number_format($property['min'], 2) }} - {{ number_format($property['max'], 2) }} / mo</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach

                    </div>

                    <div class="carousel_controls d-flex justify-content-center">
                        <i class="fa-solid fa-chevron-left" data-bs-target="#properties_carousel" data-bs-slide="prev"></i>
                        <i class="fa-solid fa-chevron-right" data-bs-target="#properties_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row videos text-center align-items-center" style="background-image: url({{ asset('img/pages/home/video-bg.png') }})">
            <div id="videos_carousel" class="carousel slide text-center">
                <div class="carousel-inner">

                @foreach ($data['videos'] as $video)
                <div class="carousel-item video_carousel_item">
                    <div class="col">
                        <iframe src="https://www.youtube.com/embed/{{ $video->code }}/"></iframe>
                    </div>
                </div>
                @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    <i class="fa-solid fa-circle-chevron-left" data-bs-target="#videos_carousel" data-bs-slide="prev"></i>
                    <i class="fa-solid fa-circle-chevron-right" data-bs-target="#videos_carousel" data-bs-slide="next"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="background-image: url({{ asset('img/pages/home/review-bg.png') }})">
        <div class="row reviews">
            <div class="col-xxl-6 reviews_title d-flex align-items-center">
                <div class="row">
                    <img src="{{  asset('img/pages/home/review-label-pc.png') }}" alt="">
                    <div class="review_carousel_controls justify-content-center d-none d-xxl-block">
                        <i class="fa-solid fa-chevron-left fa-2x" data-bs-target="#reviews_carousel" data-bs-slide="prev"></i>
                        <i class="fa-solid fa-chevron-right fa-2x" data-bs-target="#reviews_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6">
                <div id="reviews_carousel" class="carousel slide text-center">
                    <div class="carousel-inner">

                    @foreach ($data['reviews'] as $review)
                    <div class="carousel-item review_carousel_item">
                        <div class="container">
                            <div class="row review">
                                <div class="col">
                                    <div class="row profile">
                                        <div class="col-xl-2 d-flex justify-content-start col-5">
                                            <img src="{{  asset('uploads/reviews/profile_pics') }}/{{ $review->picture }}" alt="">
                                        </div>
                                        <div class="col text-start g-0">
                                            <h5>{{ $review->fullname }}</h5>
                                            <h6>{{ $review->name }}</h6>
                                            <h6>{{ \Carbon\Carbon::parse($review->reviewed_on)->toFormattedDateString()}}</h6>
                                        </div>
                                    </div>
                                    <div class="row review_text text-start">
                                        <p>{{ $review->review }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    </div>

                    <div class="d-xxl-none justify-content-center">
                        <button class="carousel-control-prev" type="button" data-bs-target="#reviews_carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        
                        <button class="carousel-control-next" type="button" data-bs-target="#reviews_carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
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

    <script src="{{ asset('js/pages/index.js') }}"></script>
@endsection