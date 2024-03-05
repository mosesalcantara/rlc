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
    <div class="container-fluid title_div">
        <div class="row title">
            <div class="col">
                <h1>RLC Residences Properties</h1>
            </div>
            <div class="col text-end">
                <h4>Let us help you with your search.</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search_div mt-3">
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

    <div class="container-fluid categories mt-3 mb-3">
        <div class="row">
            <div class="col category">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ asset('/img/pages/for_lease/residential.png') }}" alt="">
                    </div>
                    <div class="card-body text-center category_item">
                        <h1>Residential</h1>
                        <a href="/for-lease/category/residential_units" class="fa-solid fa-circle-chevron-right fa-4x"></a>
                    </div>
                </div>
            </div>
            <div class="col category">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ asset('/img/pages/for_lease/commercial.png') }}" alt="">
                    </div>
                    <div class="card-body text-center category_item">
                        <h1>Commercial</h1>
                        <a href="/for-lease/category/commercial_units" class="fa-solid fa-circle-chevron-right fa-4x"></a>
                    </div>
                </div>
            </div>
            <div class="col category">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ asset('/img/pages/for_lease/parking.png') }}" alt="">
                    </div>
                    <div class="card-body text-center">
                        <h1>Parking</h1>
                        <i class="fa-solid fa-circle-chevron-right fa-4x"></i>
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
@endsection