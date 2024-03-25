@extends('sections.pages.layout')

@section('title', 'Compare Properties')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    {{-- {{ dd($data['about']) }} --}}
    <div class="container-fluid">
        <div class="row header" style="background-image: url({{ asset('uploads/about_items/heading_images') }}/{{ $data['about']['heading_image'] }})">
            <div class="col">
                <h1>{{ $data['about']['heading_title'] }}</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid about">
        <div class="row">
            <div class="col description">
                <p>{!! nl2br($data['about']['description']) !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center tagline">
                <h4 class="mb-3">{{ $data['about']['tagline_title'] }}</h4>
                <h1>{{ $data['about']['tagline'] }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col acronym_item acronym_1">
                <div class="row">
                    <div class="col-xxl-9 d-flex justify-content-center align-items-center">
                        <div>
                            <h4>{{ $data['articles'][0]['title'] }}</h4>
                            <p>{!! nl2br($data['articles'][0]['text']) !!}</p>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <img src="{{ asset('uploads/articles/pictures') }}/{{ $data['articles'][0]['picture'] }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col shape">
                <img src="{{ asset('img/pages/about/shape-1.png') }}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col acronym_item acronym_2">
                <div class="row">
                    <div class="col">
                        <img src="{{ asset('uploads/articles/pictures') }}/{{ $data['articles'][1]['picture'] }}" alt="">
                    </div>
                    <div class="col-xxl-9 d-flex justify-content-center align-items-center">
                        <div>
                            <h4>{{ $data['articles'][1]['title'] }}</h4>
                            <p>{!! nl2br($data['articles'][1]['text']) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col shape">
                <img src="{{ asset('img/pages/about/shape-2.png') }}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col acronym_item acronym_3">
                <div class="row">
                    <div class="col-xxl-9 d-flex justify-content-center align-items-center">
                        <div>
                            <h4>{{ $data['articles'][2]['title'] }}</h4>
                            <p>{!! nl2br($data['articles'][2]['text']) !!}</p>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <img src="{{ asset('uploads/articles/pictures') }}/{{ $data['articles'][2]['picture'] }}" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <div class="container-fluid" style="background-image: url({{ asset('img/pages/home/video-bg.png') }})">
        <div class="row brand_story">
            <div class="col-xxl-6 embded-responsive d-flex align-items-center justify-content-center">
                <iframe class="embed-responsive-item video" src="https://www.youtube.com/embed/{{ $data['about']['video_code'] }}" allowfullscreen></iframe>
            </div>
            <div class="col-xxl-6 description d-flex justify-content-center align-items-center">
                <div>
                    <h2>{{ $data['about']['video_title'] }}</h2>
                    <p>{{ $data['about']['video_description'] }}</p>
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