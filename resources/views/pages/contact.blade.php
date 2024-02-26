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
            <div class="col-3 header-item">
                <h1>Let's<br>Connect</h1>
            </div>
            <div class="col header-pic" style="background-image: url({{ asset('img/pages/contact/contact-header.png') }})">

            </div>
        </div>
    </div>

    <div class="container-fluid contact">
        <div class="row">
            <div class="col contact-header">
                <h1>Got questions?</h1>
                <h1>We'd love to help you out.</h1>

                <h3>Unlock leasing oppurtunities at RLC Residences!</h3>
            </div>
            <div class="col contact-form">
                <form action="">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Inquiry Type*</label>
                            <select class="form-select" name="" id="">
                                <option value="" selected>--Select--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Full Name*</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Email*</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Contact Number*</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Message*</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="">
                                <label class="form-check-label" for="">
                                  I have read, understood, and agree with the website's privacy policy and terms of use.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button class="btn btn-warning form-btn">Get In Touch</button>
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