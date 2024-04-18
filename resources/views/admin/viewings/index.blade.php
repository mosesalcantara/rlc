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
                <h1 class="h3 mb-0 text-dark">Viewings</h1>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Viewing
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
                <h5 class="modal-title">Add Viewing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/viewings/add" method="post" enctype="multipart/form-data" id="addForm">    
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control">
                                    <label for="">Full Name</label>     
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control">
                            <label for="">Email</label>     
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="phone" class="form-control">
                                    <label for="">Contact Number</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Property</label>  
                                <select name="property_id" id="add_property_id" class="form-select"></select>
                            </div>
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Unit</label>  
                                <select name="residential_unit_id" id="add_residential_unit_id" class="form-select"></select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" name="date" class="form-control">
                                    <label for="">Viewing Date</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="time" name="time" class="form-control">
                                    <label for="">Viewing Time</label>     
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Message</label>     
                            <textarea class="form-control" name="message" cols="30" rows="5"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="" class="form-label">Status</label>     
                                <select name="status" class="form-select">
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Denied">Denied</option>
                                </select>
                            </div>
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
                <h5 class="modal-title">Update Viewing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/viewings/update" method="post" enctype="multipart/form-data" id="updForm">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" id='name' class="form-control">
                                    <label for="">Full Name</label>     
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" name="email" id='email' class="form-control">
                            <label for="">Email</label>     
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="phone" id='phone' class="form-control">
                                    <label for="">Contact Number</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Property</label>  
                                <select name="property_id" id="upd_property_id" class="form-select"></select>
                            </div>
                            <div class="col-xxl-6 mb-3">
                                <label for="" class="form-label">Unit</label>  
                                <select name="residential_unit_id" id="upd_residential_unit_id" class="form-select"></select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" name="date" id='date' class="form-control">
                                    <label for="">Viewing Date</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="time" name="time" id='time' class="form-control">
                                    <label for="">Viewing Time</label>     
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Message</label>     
                            <textarea class="form-control" name="message" id='message' cols="30" rows="5"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="" class="form-label">Status</label>     
                                <select name="status" id="status" class="form-select">
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Denied">Denied</option>
                                </select>
                            </div>
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
                <h5 class="modal-title">Delete Viewing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Viewing?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/viewings/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/viewings.js') }}"></script>
@endsection
    