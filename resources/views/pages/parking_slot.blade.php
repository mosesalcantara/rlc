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
                <h1>Parking Slots For You</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col search">
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

    <div class="container-fluid">
        <div class="row unit">
            <div class="col info">
                <div class="top">
                    <h3>{{ $data['property']['name'] }}</h3>
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <h4>{{ $data['property']['location'] }}</h4>
                    <h6>Monthly Parking Rate(s): <span>PHP {{ number_format($data['property']['min'], 2) }} - {{ number_format($data['property']['max'], 2) }} / mo</span></h6>
                </div>
                <div class="requirements">
                    <h4>PARKING LEASE REQUIREMENTS & GUIDELINES</h4>
                    @foreach ($data['property']['terms'] as $category => $terms)
                    <h5>{{ $category }}</h5>
                    <ul>
                        @foreach ($terms as $term)
                        <li>{{ $term }}</li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
                <div class="text-center">
                    <a class="btn btn-warning" href='/for-lease/property/{{ $data['property']['id'] }}'>View Project Details</a>
                </div>
            </div>
            <div class="col picture text-end" style="background-image: url({{ asset('uploads/properties/pictures') }}/{{ $data['property']['picture'] }})">
                <img src="{{ asset('uploads/properties/logos/') }}/{{ $data['property']['logo'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col rates">
                <div class="row">
                    <h3>Monthly Parking Rate(s)</h3>
                    <h6>{{ $data['property']['name'] }} Parking Rental Rates</h6>
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
                                    @foreach ($data['slots'] as $slot)
                                    <tr>
                                        <td><h6>{{ $slot['floor'] }}</h6></td>
                                        <td><h6>{{ $slot['slot'] }}</h6></td>
                                        <td><h6>PHP {{ number_format($slot['rate'], 2) }} / mo</h6></td>
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
@endsection