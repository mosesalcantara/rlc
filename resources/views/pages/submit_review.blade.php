@extends('sections.pages.layout')

@section('title', 'Contact Us')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/submit_review.css') }}">
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
                <h1>Submit A Review</h1>
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
                <form action="/submit-review" method="POST" enctype="multipart/form-data" id='review_form'>
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Full Name*</label>
                            <input class="form-control" type="text" name='fullname'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Profile Picture</label>
                            <input class="form-control" type="file" name='picture'>
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
                            <input class="form-control" type="text" name='phone'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Property*</label>
                            <select class="form-select" name="property_id">
                                @forelse ($data['properties'] as $property)
                                    <option value="{{ $property['id'] }}">{{ $property['name'] }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Review*</label>
                            <textarea class="form-control" name="review" cols="30" rows="5"></textarea>
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
                            <button class="btn btn-warning form_btn">Submit Review</button>
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