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
        <div class="row gx-0 header" style="background-image: url({{ asset('img/pages/home/shape.png') }})">
            <div class="col header_item">
                <div style="background-image: url({{ asset('img/pages/home/family.png') }})">
                    <h3>Register My Unit</h3>
                    {{-- <!-- <img src="{{ asset('img/pages/home/left-flare.png') }}" alt=""> --> --}}
                </div>
            </div>
            <div class="col header_item">
                <div style="background-image: url({{ asset('img/pages/home/building.png') }})">
                    <h3>Check Available Units</h3>
                </div>
            </div>
            <div class="col header_item">
                <div style="background-image: url({{ asset('img/pages/home/agent.png') }})">
                    <h3>Connect With Us</h3>
                    <!-- <img src="{{ asset('img/pages/home/right-flare.png') }}" alt=""> -->
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col text-center search">
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

    <div class="container-fluid featured">
        <div class="row">
            <div class="col">        
                <h1>Our Featured Properties</h1>
            </div>
            <div class="col text-end">
                <h4>Explored our wide selection of projects to know more.</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="img_carousel" class="carousel slide carousel-fade">
                    <div class="carousel-inner">

                    @foreach ($data['properties'] as $property)
                    <div class="carousel-item property_carousel_item">
                        <div class="card">
                            <div class="card_front">
                                <div class="d-flex justify-content-center align-items-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $property['picture'] }})">
                                    <i class="fa-solid fa-circle-chevron-right fa-4x front_switch"></i>
                                </div>
                            </div>
                            <div class="card_back">
                                <div class="row">

                                    <div class="col snapshot d-flex align-items-center justify-content-center mr-3">
                                        <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $property['snapshot'] }}" alt="">
                                    </div>

                                    <div class='col details align-items-center'>
                                        <div class="d-flex justify-content-end">
                                            <i class="fa-solid fa-circle-chevron-left fa-3x back_switch text-info"></i>
                                        </div>

                                        <h3>{{ $property['name'] }}</h3>
                                        <p>{{ $property['description'] }}</p>

                                        <div>
                                            <i class="fa-solid fa-location-dot fa-2x"></i>
                                            <h5>{{ $property['location'] }}</h5>
                                        </div>

                                        <div>
                                            <i class="fa-solid fa-building fa-2x"></i>
                                            <h5>{{ $property['types'] }}</h5>
                                        </div>

                                        <div>
                                            <i class="fa-solid fa-user fa-2x"></i>
                                            <h5>PHP {{ number_format($property['min'], 2) }} - {{ number_format($property['max'], 2) }} / mo</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    </div>

                    <div class="img_carousel_controls d-flex justify-content-center">
                        <i class="fa-solid fa-chevron-left fa-3x" data-bs-target="#img_carousel" data-bs-slide="prev"></i>
                        <i class="fa-solid fa-chevron-right fa-3x" data-bs-target="#img_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row videos text-center align-items-center" style="background-image: url({{ asset('img/pages/home/video-bg.png') }})">
            <div id="video_carousel" class="carousel slide carousel-fade text-center">
                <div class="carousel-inner">

                @foreach ($data['videos'] as $video)
                <div class="carousel-item video_carousel_item">
                    <div class="col video">
                        <iframe src="https://www.youtube.com/embed/{{ $video->code }}/"></iframe>
                    </div>
                </div>
                @endforeach
                </div>

                <div class="video_carousel_controls justify-content-center">
                    <i class="fa-solid fa-circle-chevron-left fa-4x" data-bs-target="#video_carousel" data-bs-slide="prev"></i>
                    <i class="fa-solid fa-circle-chevron-right fa-4x" data-bs-target="#video_carousel" data-bs-slide="next"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid reviews_div" style="background-image: url({{ asset('img/pages/home/review-bg.png') }})">
        <div class="row">
            <div class="col reviews_title d-flex align-items-center">
                <div class="row">
                    <img src="{{  asset('img/pages/home/review-label-pc.png') }}" alt="">
                    <div class="review_carousel_controls justify-content-center">
                        <i class="fa-solid fa-chevron-left fa-2x" data-bs-target="#review_carousel" data-bs-slide="prev"></i>
                        <i class="fa-solid fa-chevron-right fa-2x" data-bs-target="#review_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>

            <div class="col reviews">
                <div id="review_carousel" class="carousel slide carousel-fade text-center">
                    <div class="carousel-inner">

                    @foreach ($data['reviews'] as $review)
                    <div class="carousel-item review_carousel_item">
                        <div class="container review_cont">
                            <div class="row review">
                                <div class="col">
                                    <div class="row profile">
                                        <div class="col-2 profile_logo">
                                            <img src="{{  asset('uploads/reviews/profile_pics') }}/{{ $review->picture }}" alt="">
                                        </div>
                                        <div class="col profile_details text-start">
                                            <h2>{{ $review->fullname }}</h2>
                                            <h4>{{ $review->name }}</h4>
                                            <h4>{{ \Carbon\Carbon::parse($review->reviewed_on)->toFormattedDateString()}}</h4>
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
