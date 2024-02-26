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
    <div class="container-fluid header">
        <div class="row" style="background-image: url({{ asset('img/pages/about/about-header.jpg') }})">
            <div class="col">
                <h1>About RLC Residences</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid about_div">
        <div class="row">
            <div class="col description">
                <p>
                    Robinsons Land Corporation, a subsidiary of JG Summit Holdings, has been improving the lives of Filipinos for over 40 years.
                    Their success stems from understanding and adapting to the constantly emerging residential trends across their various developments.
                    <br><br>
                    RLC Residences, Robinsons Land's Residential Division, is made to fit your modern lifestyle and ever-changing needs.
                    From hassle-free transactions to smooth work-life integration, RLC Residences is dedicated to giving you a seamless experience.
                    Our leasing team is also committed to providing you with the best in-class leasing solutions, ensuring that you find the perfect home and business location that matches your preferences and requirements.
                    With our expertise and customer-centric approach, the RLC Residences Leasing team is here to guide you every step of the way in securing your ideal space.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center tagline">
                <h4 class="mb-3">Discover what RLC Residences has to offer through its tagline</h4>
                <div class="acronym">
                    <h2>Raise</h2>
                    <h2 class="center-h2">Live</h2>
                    <h2>Connect</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col acronym-item">
                <h4>Raise</h4>
                <p>
                    'Raise' is about helping homeowners raise their game by providing beautiful and well-designed living spaces that they can proudly call theirs.
                    RLC Residences ensures this exciting possibility by partnering with world-class designers to bring to life developments showcasing iconic features such as grand lobbies and home spaces with high ceilings equipped with upgraded deliverables where residents can happily live the lifestyle that they deserve.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col acronym-item">
                <h4>Live</h4>
                <p>
                    RLC Residences strives to continuously empower its homeowners to 'Live' and design their best life by integrating their lifestyles in every corner of the development.
                    With well-balanced life as one of the priorities of homebuyers, RLC Residences ensures that its condominium projects have above-standard amenities - both in size and variety - that cater to their wellness, growth, and recreation.
                    <br>
                    Alongside this, living their best life is also supported by the right innovations that allow them to live a smart and production life.
                    Coming from the evolving home and work trends, all RLC Residences units are also designed to have ample space to accomodate your own work-from-home-spaces, with efficient storage systems to make home life more convenient.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col acronym-item">
                <h4>Connect</h4>
                <p>
                    More than anything, everyone values connection to people and places that matter.
                    This is what 'Connect' stands for.
                    In the quest towards living an efficient and value-oriented life, RLC Residencies developments are located in strategic areas, where transport hubs, major roads, and essential destinations are easily within reach.
                    <br>
                    To ensure that residents are connected to a convenient life at home, these properties are also equipped with smart home features and digital service platforms so they can easily manage their day-to-day living.
                    All these translate to being at the center of opportunities so they can achieve their goals in life.
                </p>
            </div>
        </div>
    </div>

    
    <div class="container-fluid" style="background-image: url({{ asset('img/pages/home/video-bg.png') }})">
        <div class="row brand_story">
            <div class="col embded-responsive text-center" >
                <iframe class="embed-responsive-item video" src="https://www.youtube.com/embed/rsSbXE4Nf94" allowfullscreen></iframe>
            </div>
            <div class="col brand_story-text">
                <h2>Our Brand Story</h2>
                <p>
                    As your partner in making your aspirations a reality, we uphold our commitment to delivering projects that raise your standard of living, empowers you to live your best life, and encourage you to nurture meaningful connections.
                </p>
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