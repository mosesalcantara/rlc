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
            <div id="img_carousel" class="carousel slide carousel-fade text-center" data-bs-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/pages/home/featured-1.jpg') }}" class="featured_item" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/pages/home/featured-2.jpg') }}" class="featured_item" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/pages/home/featured-3.jpg') }}" class="featured_item" alt="">
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

    @foreach ($data['reviews'] as $review)
    {{ $review }}
@endforeach

    <div class="container-fluid">
        <div class="row videos text-center align-items-center" style="background-image: url({{ asset('img/pages/home/video-bg.png') }})">
            @foreach ($data['videos'] as $video)
            <div class="col video">
                <iframe src="https://www.youtube.com/embed/{{ $video['code'] }}/"></iframe>
            </div>
            @endforeach
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
                        @foreach ($data['first'] as $first)
                        <div class="container review_cont">
                            <div class="row review">
                                <div class="col">
                                    <div class="row profile">
                                        <div class="col-2 profile_logo">
                                            <img src="{{  asset('uploads/reviews/profile_pics') }}/{{ $first->picture }}" alt="">
                                        </div>
                                        <div class="col profile_details text-start">
                                            <h2>{{ $first->fullname }}</h2>
                                            <h4>{{ $first->name }}</h4>
                                            <h4>{{ \Carbon\Carbon::parse($first->reviewed_on)->toFormattedDateString() }}</h4>
                                        </div>
                                    </div>
                                    <div class="row review_text text-start">
                                        <p>
                                            {{ $first->review }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                                        <p>
                                            {{ $review->review }}
                                        </p>
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
