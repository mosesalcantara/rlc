@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/lease.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row title">
            <div class="col-xxl-6 d-xxl-flex align-items-center justify-content-xxl-start text-center">
                <h1>RLC Residences Properties</h1>
            </div>
            <div class="col-xxl-6 d-xxl-flex align-items-center justify-content-xxl-end text-center">
                <h4>Let us help you with your search.</h4>
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
            <input type="hidden" name='origin' value='lease_page'>
        </form>
    </div>

    <div class="container-fluid mt-3 mb-3">
        <div class="row categories">
            <div class="col-xxl-4">
                <div class="card category">
                    <img class='card-img-top' src="{{ asset('/img/pages/for_lease/residential.png') }}" alt="">
                    <div class="card-body text-center d-none d-xxl-block">
                        <h1>Residential</h1>
                        <a href="/for-lease/category/residential_units" class="fa-solid fa-chevron-right fa-3x"></a>
                    </div>

                    <div class="centered d-xxl-none">
                        <h1>Residential</h1>
                        <a href="/for-lease/category/residential_units" class="fa-solid fa-chevron-right"></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4">
                <div class="card category">
                    <img class="card-img-top" src="{{ asset('/img/pages/for_lease/commercial.png') }}" alt="">
                    <div class="card-body text-center d-none d-xxl-block">
                        <h1>Commercial</h1>
                        <a href="/for-lease/category/commercial_units" class="fa-solid fa-chevron-right fa-3x"></a>
                    </div>

                    <div class="centered d-xxl-none">
                        <h1>Commercial</h1>
                        <a href="/for-lease/category/commercial_units" class="fa-solid fa-chevron-right"></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4">
                <div class="card category">
                    <img class='card-img-top' src="{{ asset('/img/pages/for_lease/parking.png') }}" alt="">
                    <div class="card-body text-center d-none d-xxl-block">
                        <h1>Parking</h1>
                        <a href="/for-lease/category/parking_slots" class="fa-solid fa-chevron-right fa-3x"></a>
                    </div>

                    <div class="centered d-xxl-none">
                        <h1>Parking</h1>
                        <a href="/for-lease/category/parking_slots" class="fa-solid fa-chevron-right"></a>
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

    <script src="{{ asset('js/pages/lease.js') }}"></script>
@endsection