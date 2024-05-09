@extends('sections.pages.layout')

@section('title', 'Compare Properties')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/properties.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid header">
        <div class="row">
            <div class="text-center">
                <img class="header_pic" src="{{ asset('img/pages/properties/property-header.png') }}" alt="">
            </div>

            <div class="header_item">
                <h1>Compare<br>Our Properties</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid band" style="background-image: url({{ asset('img/pages/properties/gray-band.png') }})">
        <div class="row">
            <div class="col band_item">
                <h1 class="d-xxl-block d-none">Choose up to three properties and see<br>which one fits you best.</h1>
                <p class="d-xxl-block d-none">Looking to learn more about properties? <a href="/contact-us">Talk to us</a></p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col">
                <div class="row search_drops">
                    <div class="col-xxl-4">
                        <div class="dropdown" id='property_1'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Select Property</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="dropdown" id='property_2'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Select Property</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="dropdown" id='property_3'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Select Property</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid compare_div">
        <div class="row">
            <div class="col-xxl-2 compare">
                <form action="/compare-properties" method="POST" id='property_form'>
                    <div class="row">
                        <div class="col compare_item filter_property_type">
                            <h4>Property Type</h4> 
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="property_type" id="residential" value='Residential'>
                                <label class="form-check-label" for="residential">Residential</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="property_type" id="commercial" value='Commercial'>
                                <label class="form-check-label" for="commercial">Commercial</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col compare_item filter_price">
                            <h4>Rental Rate</h4>
                            {{-- <input type="range" class="form-range" id="">  --}}
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="min_price" name='min_price' class="form-control form-control-lg" />
                                        <label class="form-label" for="">From PHP</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" id="max_price" name='max_price' class="form-control form-control-lg" />
                                        <label class="form-label" for="">To PHP</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col compare_item filter_unit_type">
                            <h4>Unit Types</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='br1' id="br1">
                                <label class="form-check-label" for="">1BR</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='br2' id="br2">
                                <label class="form-check-label" for="">2BR</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='br3' id="br3">
                                <label class="form-check-label" for="">3BR</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='ph' id="ph">
                                <label class="form-check-label" for="">PH</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='studio' id="studio">
                                <label class="form-check-label" for="">Studio</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col compare_item filter_area">
                            <h4>Unit Area (sqm)</h4>
                            {{-- <input type="range" class="form-range" id="">  --}}
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="min_area" name='min_area' class="form-control form-control-lg" />
                                        <label class="form-label" for="">MIN</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" id="max_area" name='max_area' class="form-control form-control-lg" />
                                        <label class="form-label" for="">MAX</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col compare_item filter_status">
                            <h4>Unit Status</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='fully_furnished' id="fully_furnished">
                                <label class="form-check-label" for="">Fully Furnished</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='semi_furnished' id="semi_furnished">
                                <label class="form-check-label" for="">Semi-Furnished</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='unfurnished' id="unfurnished">
                                <label class="form-check-label" for="">Unfurnished</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col compare_btn">
                            <input class='btn' type="submit" value='Filter Now'>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xxl-9">
                <div class="row properties">
                    
                </div>
            </div>

            <form action="" method="POST" class="d-none" id='search_form'>
                @csrf
                <input type="hidden" name='property_id' value=''>
                <input type="hidden" name='origin' value='compare_page'>
            </form>
        </div>
    </div>

    <div class="container-fluid units_container">

    </div>

@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/properties.js') }}"></script>
@endsection