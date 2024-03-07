@extends('sections.pages.layout')

@section('title', 'For Lease')
 
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/pages/commercial_unit.css') }}">
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col property" >
                
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