@extends('sections.pages.layout')

@section('title', 'Parking Slots')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/parking_slots.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Parking Slots For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col search_drops">
                <div class="row">
                    <div class="col-3">
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
                    <div class="col-4">
                        <div class="dropdown" id='property'>
                            <button class="btn" type="button" aria-expanded="false">
                                <div class="row">
                                    <div class="col-10 d-flex justify-content-start align-items-center">
                                        <h6>Property</h6>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end align-items-center">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="dropdown" id='rate'>
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
                                <li><h6 class="dropdown-item">PHP 5,500.00 - 5,650.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 5,650.00 - 5,750.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 5,750.00 - 5,900.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 5,900.00 - 6,050.00</h6></li>
                                <li><h6 class="dropdown-item">PHP 6,050.00 - 6,200.00</h6></li>
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
            <input type="hidden" name='property_type' value=''>
            <input type="hidden" name='location' value=''>
            <input type="hidden" name='property' value=''>
            <input type="hidden" name='min_rate' value=''>
            <input type="hidden" name='max_rate' value=''>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row units">
            @if (count($data['slots']) > 0)
            @foreach ($data['slots'] as $slot)
                <div class="col-lg-4 unit">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('uploads/properties/pictures') }}/{{ $slot['picture'] }}" alt="">
                        <div class="card-body details">
                            <h3>{{ $slot['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-xl"></i>
                            <h4>{{ $slot['location'] }}</h4>
                            <div class="row table">
                                <div class="col-2">
                                    <h6>Rate</h6>
                                </div>
                                <div class="col text-dark">
                                    <h6>PHP {{ number_format($slot['min'], 2) }} - {{ number_format($slot['max'], 2) }} / mo</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <a class="btn btn-warning" href="/for-lease/category/parking_slots/{{ $slot['id'] }}">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/parking_slots.js') }}"></script>
@endsection