@extends('sections.links')
@extends('sections.navbar')
@extends('sections.footer')
@extends('sections.scripts')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RLC Residences | Leasing - Home</title>

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body style="background-image: url({{ asset('img/main-bg.png') }});">
    <div class="container-fluid header" style="background-image: url({{ asset('img/header-bg.png') }})">
        <div class="row gx-0">
            <div class="col">
                <div class="header-item" style="background-image: url({{ asset('img/family.png') }})">
                    <h3>Register My Unit</h3>
                    <!-- <img src="{{ asset('img/left-flare.png') }}" alt=""> -->
                </div>
            </div>
            <div class="col">
                <div class="header-item" style="background-image: url({{ asset('img/building.png') }})">
                    <h3>Check Available Units</h3>
                </div>
            </div>
            <div class="col">
                <div class="header-item" style="background-image: url({{ asset('img/agent.png') }})">
                    <h3>Connect With Us</h3>
                    <!-- <img src="{{ asset('img/right-flare.png') }}" alt=""> -->
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
                    <img src="{{ asset('img/featured-1.jpg') }}" class="featured_item" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/featured-2.jpg') }}" class="featured_item" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/featured-3.jpg') }}" class="featured_item" alt="">
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

    <div class="container-fluid">
        <div class="row videos">
            <div class="col embded-responsive text-center" style="background-image: url({{ asset('img/video-bg.png') }})">
                <iframe class="embed-responsive-item video" src="https://www.youtube.com/embed/ZirLYPANv1c" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container-fluid review_div" style="background-image: url({{ asset('img/review-bg.png') }})">
        <div class="row">
            <div class="col-5 review_title text-center">
                <img src="{{  asset('img/review-label-pc.png') }}" alt="">
            </div>
            <div class="col reviews">
                <div class="container review_cont">
                    <div class="row review">
                        <div class="col">
                            <div class="row profile">
                                <div class="col-2 profile_logo">
                                    <img src="{{  asset('img/profile.png') }}" alt="">
                                </div>
                                <div class="col profile_details">
                                    <h2>JC Ibanez</h2>
                                    <h4>Escalades South Metro</h4>
                                    <h4>August 2018 to present</h4>
                                </div>
                            </div>
                            <div class="row review_text">
                                <p>
                                    The property has complete amenities and ambience of the place is natural and serene.
                                    It's a great place for anyone who is looking for a family or solo home to live in.
                                    Rental rates are also cost-effective and it's also a plus for us that the property is pet-friendly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>