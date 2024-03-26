@extends('sections.pages.layout')

@section('title', 'Compare Properties')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/contact.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid header">
        <div class="row">
            <div class="col-3 header_item">
                <h1>{{ $data['contact_items']['heading_title'] }}</h1>
            </div>
            <div class="col header_pic" style="background-image: url({{ asset('uploads/contact_items/heading_images') }}/{{ $data['contact_items']['heading_image'] }})">

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
            <div class="col-xxl-5 contact_form">
                <form action="/contact-us" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Inquiry Type*</label>
                            <select class="form-select" name="type">
                                <option selected>--Select--</option>
                                <option>Residential</option>
                                <option>Commercial</option>
                                <option>Parking</option>
                                <option>Unit Registration</option>
                            </select>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Message*</label>
                            <textarea class="form-control" name="message" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='policy'>
                                <label class="form-check-label" for="">
                                  I have read, understood, and agree with the website's privacy policy and terms of use.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button class="btn btn-warning form_btn">Get In Touch</button>
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
@endsection