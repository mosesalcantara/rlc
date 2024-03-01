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
    <div class="container-fluid header" style="background-image: url({{ asset('img/pages/home/header-bg.png') }})">
        <div class="row gx-0 shape-bg" style="background-image: url({{ asset('img/pages/home/shape.png') }})">
            <div class="col">
                <div class="header-item" style="background-image: url({{ asset('img/pages/home/family.png') }})">
                    <h3>Register My Unit</h3>
                    <!-- <img src="{{ asset('img/pages/home/left-flare.png') }}" alt=""> -->
                </div>
            </div>
            <div class="col">
                <div class="header-item" style="background-image: url({{ asset('img/pages/home/building.png') }})">
                    <h3>Check Available Units</h3>
                </div>
            </div>
            <div class="col">
                <div class="header-item" style="background-image: url({{ asset('img/pages/home/agent.png') }})">
                    <h3>Connect With Us</h3>
                    <!-- <img src="{{ asset('img/pages/home/right-flare.png') }}" alt=""> -->
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid search">
        <div class="row search_div">
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

    <div class="container-fluid featured">
        <div class="row">
            <div class="col">        
                <h1>Our Featured Properties</h1>
            </div>
            <div class="col text-end">
                <h4>Explored our wide selection of projects to know more.</h4>
            </div>
        </div>
        <div class="row featured_items">
            <div class="col">
                <div id="img_carousel" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                    <div class="carousel-item active d-flex justify-content-center">
                        <div class="card flip-card featured_item">
                            <div class="card-front">
                                <div class="card-body">
                                    <img src="{{ asset('uploads/properties/pictures') }}/{{ $data['first_property']->picture }}" alt="">
                                </div>
                            </div>
                            <div class="card-back">
                                <div class="row">
                                    <div class="col-6 snapshot">
                                        <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $data['first_property_snapshot']->picture }}" alt="">
                                    </div>
                                    <div class='col'>
                                        <div class="card-body">
                                            <h2>{{ $data['first_property']->name }}</h2>
                                            <p>{{ $data['first_property']->description }}</p>

                                            <h4>{{ $data['first_property']->location }}</h4>
                                            <h4>
                                                @foreach ($data['first_property_types'] as $type)
                                                    {{ $type->type }}
                                                @endforeach
                                            </h4>
                                            <h4>PHP {{ number_format($data['first_property_min'], 2) }} - {{ number_format($data['first_property_max'], 2) }} / mo</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#img_carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#img_carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row videos text-center align-items-center" style="background-image: url({{ asset('img/pages/home/video-bg.png') }})">
            <div id="video_carousel" class="carousel slide carousel-fade text-center">
                <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="col video">
                        <iframe src="https://www.youtube.com/embed/{{ $data['first_video']->code }}/"></iframe>
                    </div>
                </div>

                @foreach ($data['videos'] as $video)
                <div class="carousel-item">
                    <div class="col video">
                        <iframe src="https://www.youtube.com/embed/{{ $video->code }}/"></iframe>
                    </div>
                </div>
                @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#video_carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#video_carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid reviews_div" style="background-image: url({{ asset('img/pages/home/review-bg.png') }})">
        <div class="row">
            <div class="col reviews_title d-flex align-items-center">
                <img src="{{  asset('img/pages/home/review-label-pc.png') }}" alt="">
            </div>

            <div class="col reviews">
                <div id="review_carousel" class="carousel slide carousel-fade text-center">
                    <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="container review_cont">
                            <div class="row review">
                                <div class="col">
                                    <div class="row profile">
                                        <div class="col-2 profile_logo">
                                            <img src="{{  asset('uploads/reviews/profile_pics') }}/{{ $data['first_review']->picture }}" alt="">
                                        </div>
                                        <div class="col profile_details text-start">
                                            <h2>{{ $data['first_review']->fullname }}</h2>
                                            <h4>{{ $data['first_review']->name }}</h4>
                                            <h4>{{ \Carbon\Carbon::parse($data['first_review']->reviewed_on)->format('F d, Y') }}</h4>
                                        </div>
                                    </div>
                                    <div class="row review_text text-start">
                                        <p>
                                            {{ $data['first_review']->review }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($data['reviews'] as $review)
                    <div class="carousel-item">
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
                    <button class="carousel-control-prev" type="button" data-bs-target="#review_carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#review_carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
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
@endsection
