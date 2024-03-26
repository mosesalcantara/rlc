@extends('sections.pages.layout')

@section('title', 'For Sale')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/pre_selling.css') }}">
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    {{-- {{ dd($data['properties']) }} --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col title">
                <h1>Pre-Selling</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row properties">
            @if (count($data['properties']) > 0)
            @foreach ($data['properties'] as $property)
                <div class="col-lg-4 property">
                    <div class="card">
                        <img class='card-img-top' src="{{ asset('uploads/properties/pictures') }}/{{ $property['picture'] }}" alt="">
                        <div class="card-body details">
                            <h3>{{ $property['name'] }}</h3>
                            <i class="fa-solid fa-location-dot fa-xl"></i>
                            <h4>{{ $property['location'] }}</h4>
                            <div class="row table">
                                <div class="col-4">
                                    <h6>Price Range</h6>
                                    <h6>Unit Types</h6>
                                </div>
                                <div class="col text-dark">
                                    <h6>{{ $property['min_price'] }}M - {{ $property['max_price'] }}M PHP</h6>
                                    <h6>{{ $property['unit_types'] }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <a class="btn btn-warning" href="/for-sale/property/{{ $property['id'] }}">VIEW PROPERTY</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="col text-center no_data">
                    No data available
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/pages/pre_selling.js') }}"></script>
@endsection