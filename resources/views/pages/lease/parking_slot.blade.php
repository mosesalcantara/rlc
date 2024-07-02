@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/parking_slot.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1 class="text-center text-xxl-start">Parking Slots For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row search mt-3">
            <div class="col">
                <div class="row search_drops">
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
                    <div class="col-xxl-4">
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
                    <div class="col-xxl-4">
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
            <input type="hidden" name='location' value=''>
            <input type="hidden" name='name' value=''>
            <input type="hidden" name='min_rate' value=''>
            <input type="hidden" name='max_rate' value=''>
            <input type="hidden" name='origin' value='parking_slot_page'>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row unit">
            <div class="col-12 col-xxl info order-xxl-first order-last">
                <div class="top">
                    <h3>{{ $data['property']['name'] }}</h3>
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <h4>{{ $data['property']['location'] }}</h4>
                    <h6>Monthly Parking Rate(s): <span>{{ $data['property']['price'] }}</span></h6>
                </div>
                <div class="requirements">
                    <h4>PARKING LEASE REQUIREMENTS & GUIDELINES</h4>
                    @forelse ($data['property']['terms'] as $category => $terms)
                        <h5>{{ $category }}</h5>
                        <ul>
                            @forelse ($terms as $term)
                                <li>{{ $term }}</li>
                            @empty
                            
                            @endforelse
                        </ul>
                    @empty
                        <div class="text-center no_data">
                            No data available
                        </div>
                    @endforelse
                </div>
                <div class="text-center">
                    <a class="btn btn-warning" href='/for-lease/property/{{ $data['property']['id'] }}'>View Project Details</a>
                </div>
            </div>
            <div class="col-12 col-xxl picture text-end order-xxl-last order-first" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['property']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['property']['logo'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col rates">
                <div class="row">
                    <h3 class="text-center text-xxl-start">Monthly Parking Rate(s)</h3>
                    <h6 class="text-center text-xxl-start">{{ $data['property']['name'] }} Parking Rental Rates</h6>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-center text-center tbl_slots">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Floor</th>
                                        <th>Single/Tandem Slot</th>
                                        <th>Rental Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['slots'] as $slot)
                                        <tr>
                                            <td><h6>{{ $slot['floor'] }}</h6></td>
                                            <td><h6>{{ $slot['slot'] }}</h6></td>
                                            <td><h6>PHP {{ number_format($slot['rate'], 2) }} / mo</h6></td>
                                        </tr>
                                    @empty
                                        <div class="text-center no_data">
                                            No data available
                                        </div>
                                    @endforelse
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

    <script src="{{ asset('js/pages/parking_slot.js') }}"></script>
@endsection