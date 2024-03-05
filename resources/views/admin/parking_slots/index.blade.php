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
    <div class="container">
        <div class="row">
            <div class="col mb-3">
                <h1 class="h3 mb-0 text-dark">Parking Slots</h1>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Slot
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
                <h5 class="modal-title">Add Parking Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/parking/add" method="post" enctype="multipart/form-data" id="addForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Property</label>  
                            <select name="property_id" id="add_property_id" class="form-select"></select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="floor" class="form-control">
                            <label for="">Floor</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Single / Tandem Slot</label>  
                            <select name="slot" class="form-select">
                                <option value="Single Slot">Single Slot</option>
                                <option value="Tandem Slot">Tandem Slot</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="rate" class="form-control">
                            <label for="">Rate</label>     
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
                <h5 class="modal-title">Update Parking Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/parking/update" method="post" enctype="multipart/form-data" id="updForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Property</label>  
                            <select name="property_id" id="upd_property_id" class="form-select"></select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="floor" id='floor' class="form-control">
                            <label for="">Floor</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Single / Tandem Slot</label>  
                            <select name="slot" id='slot' class="form-select">
                                <option value="Single Slot">Single Slot</option>
                                <option value="Tandem Slot">Tandem Slot</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="rate" id='rate' class="form-control">
                            <label for="">Rate</label>     
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
                <h5 class="modal-title">Delete Parking Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Parking Slot?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/parking/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/parking_slots.js') }}"></script>
@endsection
    