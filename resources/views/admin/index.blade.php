@extends('sections.admin.layout')

@section('title', 'Dashboard')
 
@section('links')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('main')
    @parent
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Properties (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['properties'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-building fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Residential Units (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['residential_units'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-house fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Commercial Units (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['commercial_units'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-store fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Parking Slots (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['parking_slots'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-square-parking fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
@endsection
