@extends('sections.pages.layout')

@section('title', 'For Sale')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/sale_property.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col" >
                <div id="pictures_carousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($data['property']['pictures'] as $picture)
                        <div class="carousel-item picture_carousel_item">
                            <div class="picture" style="background-image: url({{ asset('uploads/properties/pictures') }}//{{ $picture }});"> 
                                <div class="row">
                                    <div class="col-4">
                                        <div class="logo d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('uploads/properties/logos') }}/{{ $data['property']['logo'] }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#pictures_carousel" data-bs-slide="prev">
                        <i class="fa-solid fa-chevron-left fa-2x"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#pictures_carousel" data-bs-slide="next">
                        <i class="fa-solid fa-chevron-right fa-2x"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row about">
            <div class="col title">
                <h4>About This Property</h4>
            </div>
        </div>
        <div class="row info">
            <div class="col-xxl-6 maps">
                <img src="{{ asset('uploads/properties/pictures') }}/{{ $data['property']['pictures'][0] }}" alt="">
            </div>
            <div class="col-xxl-6 details">
                <div class="row">
                    <div class="col text-center text-xxl-start">
                        <h4>{{ $data['property']['name'] }}</h4>
                        <i class="fa-solid fa-location-dot fa-xl"></i>
                        <h5>{{ $data['property']['location'] }}</h5>
                    </div>
                </div>
                <div class="row rates_types">
                    <div class="col-xxl col-12 rates text-xxl-start text-center">
                        <h5>Price Range</h5>
                        <h5>PHP{{ $data['property']['min'] }}M - PHP{{ $data['property']['max'] }}M</h5>
                    </div>
                    <div class="col-xxl col-12 types text-xxl-start text-center">
                        <h5>Unit Types</h5>
                        <h5>{{ $data['property']['types'] }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col description">
                        <p>{{ $data['property']['description'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid amenities">
        <div class="row title">
            <div class="col text-xxl-start text-center">
                <h4>Amenities and Features</h4>
            </div>
        </div>
        <div class="row categories">
            <div class="col">
                <div class="row text-center category_indoor">
                    <h4>Indoor</h4>
                </div>
                <div class="row indoors">
                    @foreach ($data['property']['indoor'] as $amenity)
                    <div class="col-xxl-2">
                        <h5 class='amenity' data-picture='{{ $amenity['picture'] }}' data-name='{{ $amenity['name'] }}' data-bs-target="#picModal" data-bs-toggle="modal">{{ $amenity['name'] }}</h5>
                    </div>
                    @endforeach
                </div>
                <div class="row text-center category_outdoor">
                    <h4>Outdoor</h4>
                </div>
                <div class="row outdoors">
                    @foreach ($data['property']['outdoor'] as $amenity)
                    <div class="col-xxl-2">
                        <h5 class='amenity' data-picture='{{ $amenity['picture'] }}' data-name='{{ $amenity['name'] }}' data-bs-target="#picModal" data-bs-toggle="modal">{{ $amenity['name'] }}</h5>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal" tabindex="-1" id="picModal">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id='amenity_name'></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="amenity_picture" src="" alt="">
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

    <script src="{{ asset('js/pages/sale_property.js') }}"></script>
@endsection