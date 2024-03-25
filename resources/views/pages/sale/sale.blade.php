@extends('sections.pages.layout')

@section('title', 'For Sale')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/sale.css') }}">
@endsection

@section('navbar')
    @parent
@endsection


@section('content')
    <div class="container-fluid mt-3 mb-3">
        <div class="row categories d-flex justify-content-center align-items-center">
            <div class="col-xxl-4">
                <div class="card category">
                    <img class='card-img-top' src="{{ asset('/img/pages/for_lease/residential.png') }}" alt="">
                    <div class="card-body text-center d-none d-xxl-block">
                        <h1>Pre-Selling</h1>
                        <a href="/for-sale/category/pre-selling" class="fa-solid fa-chevron-right fa-3x"></a>
                    </div>

                    <div class="centered d-xxl-none">
                        <h1>Pre-Selling</h1>
                        <a href="/for-sale/category/pre-selling" class="fa-solid fa-chevron-right"></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4">
                <div class="card category">
                    <img class="card-img-top" src="{{ asset('/img/pages/for_lease/residential.png') }}" alt="">
                    <div class="card-body text-center d-none d-xxl-block">
                        <h1>RFO</h1>
                        <a href="/for-sale/category/rfo" class="fa-solid fa-chevron-right fa-3x"></a>
                    </div>

                    <div class="centered d-xxl-none">
                        <h1>RFO</h1>
                        <a href="/for-sale/category/rfo" class="fa-solid fa-chevron-right"></a>
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

    <script src="{{ asset('js/pages/sale.js') }}"></script>
@endsection