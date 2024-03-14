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
            
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col search_drops">
                <div class="row">
                    <div class="col-3">
                        <div class="dropdown" id='property_type'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6 class="drop_h6">Property Type</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="dropdown" id='location'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6 class="drop_h6">Location</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dropdown" id='type'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6 class="drop_h6">Type of Unit</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="dropdown" id='rate'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6 class="drop_h6">Rental Rate</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <button class="btn btn-warning search_btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
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
                <div id="properties_carousel" class="carousel slide">
                    <div class="carousel-inner">

                    @foreach ($data['properties'] as $property)
                    <div class="carousel-item property_carousel_item">
                        <div class="card">
                            <div class="card_front">
                                <div class="d-flex justify-content-center align-items-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $property['picture'] }})">
                                    {{-- <img class="logo" src="{{ asset('uploads/properties/logos') }}/{{ $property['logo'] }}" alt=""> --}}
                                    <i class="fa-solid fa-circle-chevron-right fa-4x front_switch"></i>
                                </div>
                            </div>
                            <div class="card_back">
                                <div class="row">

                                    <div class="col snapshot d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('uploads/residential_units/snapshots') }}/{{ $property['snapshot'] }}" alt="">
                                    </div>

                                    <div class='col details'>
                                        <div class="d-flex justify-content-end">
                                            <i class="fa-solid fa-circle-chevron-left fa-3x back_switch text-info"></i>
                                        </div>

                                        <h3>{{ $property['name'] }}</h3>
                                        <p>{{ $property['description'] }}</p>

                                        <div>
                                            <i class="fa-solid fa-location-dot fa-xl"></i>
                                            <h5>{{ $property['location'] }}</h5>
                                        </div>

                                        <div>
                                            <i class="fa-solid fa-building fa-xl"></i>
                                            <h5>{{ $property['types'] }}</h5>
                                        </div>

                                        <div>
                                            <i class="fa-solid fa-user fa-xl"></i>
                                            <h5>PHP {{ number_format($property['min'], 2) }} - {{ number_format($property['max'], 2) }} / mo</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    </div>

                    <div class="carousel_controls d-flex justify-content-center">
                        <i class="fa-solid fa-chevron-left fa-2x" data-bs-target="#properties_carousel" data-bs-slide="prev"></i>
                        <i class="fa-solid fa-chevron-right fa-2x" data-bs-target="#properties_carousel" data-bs-slide="next"></i>
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

                <div class="justify-content-center">
                    <i class="fa-solid fa-circle-chevron-left fa-4x" data-bs-target="#videos_carousel" data-bs-slide="prev"></i>
                    <i class="fa-solid fa-circle-chevron-right fa-4x" data-bs-target="#videos_carousel" data-bs-slide="next"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="background-image: url({{ asset('img/pages/home/review-bg.png') }})">
        <div class="row reviews">
            <div class="col reviews_title d-flex align-items-center">
                <div class="row">
                    <img src="{{  asset('img/pages/home/review-label-pc.png') }}" alt="">
                    <div class="review_carousel_controls justify-content-center">
                        <i class="fa-solid fa-chevron-left fa-2x" data-bs-target="#reviews_carousel" data-bs-slide="prev"></i>
                        <i class="fa-solid fa-chevron-right fa-2x" data-bs-target="#reviews_carousel" data-bs-slide="next"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div id="reviews_carousel" class="carousel slide text-center">
                    <div class="carousel-inner">

                    @foreach ($data['reviews'] as $review)
                    <div class="carousel-item review_carousel_item">
                        <div class="container">
                            <div class="row review">
                                <div class="col">
                                    <div class="row profile">
                                        <div class="col-2">
                                            <img src="{{  asset('uploads/reviews/profile_pics') }}/{{ $review->picture }}" alt="">
                                        </div>
                                        <div class="col text-start">
                                            <h2>{{ $review->fullname }}</h2>
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