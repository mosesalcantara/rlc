@extends('sections.pages.layout')

@section('title', 'Compare Properties')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/unit_registration.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid header">
        <div class="row">
            <div class="text-center">
                <img class="header_pic" src="{{ asset('uploads/contact_items/heading_images') }}/{{ $data['contact_items']['heading_image'] }}" alt="">
            </div>

            <div class="header_item">
                <h1>Unit Registration</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid contact">
        <div class="row">
            <div class="col contact_header d-flex justify-content-center align-items-center">
                <div>
                    <h1>{{ $data['contact_items']['title'] }}</h1>

                    <h3>{{ $data['contact_items']['subtitle'] }}</h3>
                </div>
            </div>
            <div class="col-xxl-5 registration_div">
                <form action="/unit-registration" method="POST" enctype="multipart/form-data" id='registration_form'>
                    @csrf
                    <div class="step-1">
                        <h4 class="text-center">Contact Details</h4>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Full Name*</label>
                                <input class="form-control" type="text" name='fullname'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Email*</label>
                                <input class="form-control" type="text" name='email'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Contact Number*</label>
                                <input class="form-control" type="text" name='contact_number'>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn btn-primary next_btn" type='button'>Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="step-2">
                        <h4 class="text-center">Unit Details</h4>
                        <div class="property_details">
                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Registration Type*</label>
                                    <select class="form-select" name="retail_status">
                                        <option selected>--Select--</option>
                                        <option>For Sale</option>
                                        <option>For Lease</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="" class="form-label">Property*</label>
                                    <select class="form-select" name="property_id">
                                        @foreach ($data['properties'] as $property)
                                        <option value="{{ $property['id'] }}">{{ $property['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label">Building*</label>
                                    <select class="form-select" name="building_id">
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label">Unit ID*</label>
                                    <input class="form-control" type="text" name='unit_id'>
                                </div>
                            </div>

                            <div class="row">

                            </div>
                        </div>

                        <div class="unit_details">
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="form-label">Unit Type*</label>
                                    <select class="form-select" name="type">
                                        <option>1BR</option>
                                        <option>2BR</option>
                                        <option>3BR</option>
                                        <option>PH</option>
                                        <option>Studio</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Unit Status*</label>
                                    <select class="form-select" name="status">
                                        <option>Unfurnished</option>
                                        <option>Semi-furnished</option>
                                        <option>Fully Furnished</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="form-label">Area (sqm)*</label>
                                    <input class="form-control" type="text" name='area'>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Price*</label>
                                    <input class="form-control" type="text" name='price'>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn btn-primary prev_btn" type='button'>Previous</button>
                                <button class="btn btn-primary next_btn" type='button'>Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="step-3">
                        <h4 class="text-center">Snapshots and Videos</h4>

                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Snapshots*</label>
                                <input class="form-control" type="file" name='picture[]' multiple>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Videos*</label>
                                <input class="form-control" type="file" name='video[]' multiple>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn btn-primary prev_btn" type='button'>Previous</button>
                                <input type="submit" class="btn btn-primary submit_btn" value="Register">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/unit_registration.js') }}"></script>
@endsection