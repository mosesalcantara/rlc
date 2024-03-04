@extends('sections.pages.layout')

@section('title', 'Home')
 
@section('links')
    @parent
    
  <style>
    .picture {
      width: 100vw;
      height: 70vh;
    }
  </style>
@endsection

@section('navbar')
    @parent
@endsection
 
@section('content')
<div class="picture d-flex align-items-end justify-content-center" style="background-image: url('uploads/properties/pictures/1709515263.jpg')">
  <i class="fa-solid fa-circle-chevron-right fa-4x front_switch"></i>
</div>

@endsection


@section('footer')
    @parent
@endsection

@section('scripts')
    @parent

@endsection