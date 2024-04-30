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

    {{-- {{ dd($data) }} --}}

    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
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
        
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
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

            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
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
        
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
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
        
        <div class="row px-5">
            <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
                                    Inquiries (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['inquiries'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-question fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
                                    Viewings (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['viewings'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-clipboard-question fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col mr-2">
                                <div class="fw-bold text-primary text-uppercase mb-1">
                                    Registrations (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $data['counts']['registered_units'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-house-circle-exclamation fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body d-flex justify-content-center text-center">
                        <div>
                            <h4>Retail Shares</h4>
                            <canvas id="retail_status"></canvas>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <h4 class="text-center">For Lease Shares</h4>
                            <canvas id="for_lease"></canvas>    
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Amenities Per Property</h4>
                        <canvas id="amenities_property"></canvas>  
                    </div>
                </div> 
            </div>
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Reviews Per Property</h4>
                        <canvas id="reviews_property"></canvas> 
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/admin/index.js') }}"></script>
@endsection
