@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/commercial_unit.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Commercial Units For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col search_drops">
                <div class="row">
                    <div class="col-5">
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
                    <div class="col-6">
                        <div class="dropdown" id='area'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Area Size</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                            <ul class='dropdown-menu'>
                                <li><h6 class="dropdown-item">10.00 - 350.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">350.00 - 700.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">700.00 - 1050.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">1050.00 - 1400.00 SQM</h6></li>
                                <li><h6 class="dropdown-item">1400.00 - 1750.00 SQM</h6></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center search_btn">
                        <button class="btn btn-warning">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form action="" method="POST" class="d-none" id='search_form'>
            @csrf
            <input type="hidden" name='location' value=''>
            <input type="hidden" name='min_area' value=''>
            <input type="hidden" name='max_area' value=''>
            <input type="hidden" name='origin' value='commercial_unit_page'>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row unit">
            <div class="col info">
                <div class="top">
                    <h3>{{ $data['c_unit']['name'] }}</h3>
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <h4>{{ $data['c_unit']['location'] }}</h4>
                </div>
                <div>
                    <h6>Retail ID: {{ $data['c_unit']['retail_id'] }}</h6>
                    <h6>Building: {{ $data['c_unit']['building'] }}</h6>
                    <h6>Size: {{ $data['c_unit']['size'] }}</h6>
                </div>
                <div class="text-center">
                    <a class="btn btn-warning" href='/for-lease/property/{{ $data['c_unit']['property_id'] }}'>View Project Details</a>
                </div>
            </div>
            <div class="col picture text-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['c_unit']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['c_unit']['logo'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col floor_plan">
                <div class="row">
                    <h1>Floor Plan</h1>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-center">
                            <img src="{{ asset('uploads/buildings/floor_plans/') }}/{{ $data['c_unit']['floor_plan'] }}" alt="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row d-flex justify-content-center text-center tbl_measurements">
                            <table class="table table-sm">
                                <tbody>
                                    @foreach ($data['measurements'] as $measurement)
                                    <tr>
                                        <td><h6>{{ $measurement['retail_id'] }}</h6></td>
                                        <td><h6>{{ $measurement['size'] }} sqm</h6></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

    <script src="{{ asset('js/pages/commercial_unit.js') }}"></script>
@endsection