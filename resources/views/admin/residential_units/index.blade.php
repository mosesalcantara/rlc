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
            <div class="col d-flex justify-content-end">
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
                        <div class="row">
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Property</label>  
                                <select name="property_id" id="add_property_id" class="form-select"></select>
                            </div>
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Building</label>  
                                <select name="building_id" id="add_building_id" class="form-select"></select>
                            </div>
                        </div>  
                        <div class="form-floating mb-3">
                            <input type="text" name="unit_id" class="form-control">
                            <label for="">Unit ID</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Retail Status</label>     
                            <select name="retail_status" class="form-select">
                                <option value="For Sale">For Sale</option>
                                <option value="For Lease">For Lease</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Unit Type</label>     
                                <select name="type" class="form-select">
                                    <option value="1BR">1 Bedroom</option>
                                    <option value="2BR">2 Bedrooms</option>
                                    <option value="3BR">3 Bedrooms</option>
                                    <option value="PH">Penthouse</option>
                                    <option value="Studio">Studio</option>
                                </select>
                            </div>
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Unit Status</label>     
                                <select name="status" class="form-select">
                                    <option value="Unfurnished">Unfurnished</option>
                                    <option value="Semi-furnished">Semi-furnished</option>
                                    <option value="Fully Furnished">Fully Furnished</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 form-floating mb-3">
                                <input type="text" name="area" class="form-control">
                                <label for="">Area (SQM)</label>     
                            </div>
                            <div class="col-xxl-6 form-floating mb-3">
                                <input type="text" name="price" class="form-control">
                                <label for="">Price</label>     
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Publish Status</label>     
                            <select name="published" class="form-select">
                                <option value="0">Unpublished</option>
                                <option value="1">Published</option>
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
                        <div class="row">
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Property</label>  
                                <select name="property_id" id="upd_property_id" class="form-select"></select>
                            </div>
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Building</label>  
                                <select name="building_id" id="upd_building_id" class="form-select"></select>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="unit_id" id="unit_id" class="form-control">
                            <label for="">Unit ID</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Retail Status</label>     
                            <select name="retail_status" id="retail_status" class="form-select">
                                <option value="For Sale">For Sale</option>
                                <option value="For Lease">For Lease</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Unit Type</label>     
                                <select name="type" id="type" class="form-select">
                                    <option value="1BR">1 Bedroom</option>
                                    <option value="2BR">2 Bedrooms</option>
                                    <option value="3BR">3 Bedrooms</option>
                                    <option value="PH">Penthouse</option>
                                    <option value="Studio">Studio</option>
                                </select>
                            </div>
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Unit Status</label>     
                                <select name="status" id="status" class="form-select">
                                    <option value="Unfurnished">Unfurnished</option>
                                    <option value="Semi-furnished">Semi-furnished</option>
                                    <option value="Fully Furnished">Fully Furnished</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 form-floating mb-3">
                                <input type="text" name="area" id="area" class="form-control">
                                <label for="">Area (SQM)</label>     
                            </div>
                            <div class="col-xxl-6 form-floating mb-3">
                                <input type="text" name="price" id="price" class="form-control">
                                <label for="">Price</label>     
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Publish Status</label>     
                            <select name="published" id='published' class="form-select">
                                <option value="0">Unpublished</option>
                                <option value="1">Published</option>
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
    