@extends('sections.pages.layout')

@section('title', 'Compare Properties')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/calculator.css') }}">
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
                <h1>Housing Loan Calculator</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid calculator_div">
        <div class="row">
            <div class="col-xxl-4 offset-xxl-2 calculator">
                <div class="row mb-3">
                    <div class="col calculator_item">
                        <h4>Property Type</h4>
                        <select class="form-select" id="type">
                            <option selected></option>
                            <option>Residential Condominium</option>
                            <option>House and Lot (Purchase and Construction)</option>
                            <option>Lot Purchase</option>
                            <option>Property Acquisition (OFW)</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col calculator_item">
                        <h4>Selling Price</h4>
                        <input type="text" id="price" class="form-control form-control-lg" />
                    </div>
                    <div class="col calculator_item">
                        <h4>Down Payment</h4>
                        <select class="form-select" id="down">
                            <option selected></option>
                            <option>20%</option>
                            <option>30%</option>
                            <option>40%</option>
                            <option>50%</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col calculator_item">
                        <h4>Interest Rate</h4>
                        <input type="text" id="interest" class="form-control form-control-lg" />
                    </div>
                    <div class="col calculator_item">
                        <h4>Payment Terms</h4>
                        <input type="text" id="terms" class="form-control form-control-lg" />
                    </div>
                </div>
                <div class="row calculator_btns mb-3">
                    <div class="col-6">
                        <button id='compute_btn'>Compute</button>
                    </div>
                    <div class="col-6">
                        <button id='clear_btn'>Clear</button>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 result">

            </div>
        </div>
    </div>

@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/calculator.js') }}"></script>
@endsection