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
    <div class="container-fluid header" style="background-image: url({{ asset('img/pages/properties/property-header.png') }})">
        <div class="row">
            <div class="col-4 header_item">
                <h1>Compare<br> Our Properties</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid band" style="background-image: url({{ asset('img/pages/properties/gray-band.png') }})">
        <div class="row">
            <div class="col band_item">
                <h1>Choose up to three properties and see<br>which one fits you best.</h1>
                <p>Looking to learn more about properties? <a href="">Talk to us</a></p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search_div mt-3">
            <div class="col search_drops text-center">
                <select name="" id="" class="form-select">
                    <option value="" selected>Select Property</option>
                </select>
                <select name="" id="" class="form-select">
                    <option value="" selected>Select Property</option>
                </select>
                <select name="" id="" class="form-select">
                    <option value="" selected>Select Property</option>
                </select>
            </div>
        </div>
    </div>

    <div class="container-fluid compare">
        <div class="row">
            <div class="col compare_item">
                <h4>Property Type</h4> 
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="" id="">
                    <label class="form-check-label" for="">
                        Residential
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="" id="">
                    <label class="form-check-label" for="">
                        Commercial
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col compare_item">
                <h4>Rental Rate</h4>
                <input type="range" class="form-range" id=""> 
                
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" id="" name='' class="form-control form-control-lg" />
                            <label class="form-label" for="">From PHP</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" id="" name='' class="form-control form-control-lg" />
                            <label class="form-label" for="">To PHP</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col compare_item">
                <h4>Unit Types</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      1BR
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      2BR
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      3BR
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      PH
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      Studio
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col compare_item">
                <h4>Unit Area (sqm)</h4>
                <input type="range" class="form-range" id=""> 
                
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" id="" name='' class="form-control form-control-lg" />
                            <label class="form-label" for="">MIN</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" id="" name='' class="form-control form-control-lg" />
                            <label class="form-label" for="">MAX</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col compare_item">
                <h4>Unit Status</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      Fully Furnished
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      Semi-Furnished
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      Unfurnished
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col compare_btn">
                <button class="btn">Filter Now</button>
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