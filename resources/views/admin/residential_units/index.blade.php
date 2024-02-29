@extends('sections.admin.layout')

@section('title', 'Dashboard')
    
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/admin/crud.css') }}">
@endsection

@section('sidebar')
    @parent
@endsection

@section('main')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col mb-3">
                <h1 class="h3 mb-0 text-dark">Residential Units</h1>
            </div>
            <div clas="col">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Unit
                </button>
            </div>
        </div>
    </div>

    <div class="container" id="tbl_div">

    </div>

    <div class="container">
        <div class="modal" tabindex="-1" id="addModal">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Add Residential Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/residential/add" method="post" enctype="multipart/form-data" id="addForm">         
                        <div class="mb-3">
                            <label for="" class="form-label">Property</label>  
                            <select name="property_id" id="add_property_id" class="form-select"></select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="unit_id" class="form-control">
                            <label for="">Unit ID</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="building" class="form-control">
                            <label for="">Building</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Unit Type</label>     
                            <select name="type" class="form-select">
                                <option value="1 BR">1 Bedroom</option>
                                <option value="2 BR">2 Bedrooms</option>
                                <option value="3 BR">3 Bedrooms</option>
                                <option value="PH">Penthouse</option>
                                <option value="Studio">Studio</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="area" class="form-control">
                            <label for="">Area</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="rate" class="form-control">
                            <label for="">Monthly Rate</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Unit Status</label>     
                            <select name="status" class="form-select">
                                <option value="Not Furnished">Not Furnished</option>
                                <option value="Semi Furnished">Semi Furnished</option>
                                <option value="Fully Furnished">Fully Furnished</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal" tabindex="-1" id="updModal">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Update Residential Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/residential/update" method="post" enctype="multipart/form-data" id="updForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Property</label>  
                            <select name="property_id" id="upd_property_id" class="form-select"></select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="unit_id" id="unit_id" class="form-control">
                            <label for="">Unit ID</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="building" id="building" class="form-control">
                            <label for="">Building</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Unit Type</label>     
                            <select name="type" id="type" class="form-select">
                                <option value="1 BR">1 Bedroom</option>
                                <option value="2 BR">2 Bedrooms</option>
                                <option value="3 BR">3 Bedrooms</option>
                                <option value="PH">Penthouse</option>
                                <option value="Studio">Studio</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="area" id="area" class="form-control">
                            <label for="">Area</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="rate" id="rate" class="form-control">
                            <label for="">Monthly Rate</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Unit Status</label>     
                            <select name="status" id="status" class="form-select">
                                <option value="Not Furnished">Not Furnished</option>
                                <option value="Semi Furnished">Semi Furnished</option>
                                <option value="Fully Furnished">Fully Furnished</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                        <input type="hidden" value="0" name="upd_id" id="upd_id">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal" tabindex="-1" id="delModal">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Delete Residential Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Residential Unit?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/residential/delete/" method="POST" id="delForm">
                        <input type="hidden" value="0" id="del_id" name="del_id">
                        <input type="submit" class="btn btn-primary" value="Yes" style="cursor:pointer;">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </form>    
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/admin/residential_units.js') }}"></script>
@endsection
    