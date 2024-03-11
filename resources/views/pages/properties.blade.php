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
                <h1>Compare<br>Our Properties</h1>
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
                <div class="row">
                    <div class="col">
                        <div class="dropdown" id='property_1'>
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Property
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dropdown" id='property_2'>
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Property
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dropdown" id='property_3'>
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Property
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 compare">
                <form action="/compare-properties" method="POST" id='property_form'>
                    <div class="row">
                        <div class="col compare_item">
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
                        <div class="col compare_item">
                            <h4>Rental Rate</h4>
                            <input type="range" class="form-range" id=""> 
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="min_rate" name='min_rate' class="form-control form-control-lg" />
                                        <label class="form-label" for="">From PHP</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" id="max_rate" name='max_rate' class="form-control form-control-lg" />
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
                                <input class="form-check-input" type="checkbox" name='type' value="1BR" id="br1">
                                <label class="form-check-label" for="">1BR</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2BR" name='type' id="br2">
                                <label class="form-check-label" for="">2BR</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="3BR" name='type' id="br3">
                                <label class="form-check-label" for="">3BR</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="PH" name='type' id="ph">
                                <label class="form-check-label" for="">PH</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Studio" name='type' id="studio">
                                <label class="form-check-label" for="">Studio</label>
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
                        <div class="col compare_item">
                            <h4>Unit Status</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Fully Furnished" name='status' id="fully_furnished">
                                <label class="form-check-label" for="">
                                  Fully Furnished
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Semi Furnished" name='status' id="semi_furnished">
                                <label class="form-check-label" for="">
                                  Semi-Furnished
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Unfurnished" name='status' id="unfurnished">
                                <label class="form-check-label" for="">
                                  Unfurnished
                                </label>
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
            <div class="col">
                <div class="row properties">
                    
                </div>
            </div>
        </div>

        <div class="row residential_units">
            <div class="col">
                <div class="row">
                    <h5>Axis Residences (10) results</h5>
                </div>
                <div class="row">
                    <div class="col-3 unit">
                        <div class="card">
                            <div class="card-header">
                                <img class="snapshot" src="{{ asset('uploads/properties/pictures/1709259926.jpg') }}" alt="">
                            </div>
                            <div class="card-body">
                                <h6>Mandaluyong City</h6>
                                <h6>Axis Residences</h6>
                                <div class="row">
                                    <div class="col">
                                        <h6>Unit ID</h6>
                                        <h6>Property Type</h6>
                                        <h6>Monthly Rate</h6>
                                        <h6>Unit Type</h6>
                                        <h6>Unit Area</h6>
                                        <h6>Unit Status</h6>
                                    </div>
                                    <div class="col">
                                        <h6>AXRO1</h6>
                                        <h6>Residential</h6>
                                        <h6>PHP 25,000.00</h6>
                                        <h6>Studio</h6>
                                        <h6>23.76 sqm</h6>
                                        <h6>Fully Furnished</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/pages/properties.js') }}"></script>
@endsection