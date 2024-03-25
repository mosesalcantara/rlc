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
                <h1 class="h3 mb-0 text-dark">Properties</h1>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Property
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
                <h5 class="modal-title">Add Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/properties/add" method="post" enctype="multipart/form-data" id="addForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Logo</label>     
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control">
                            <label for="">Name</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="location" class="form-control">
                            <label for="">Location</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>     
                            <textarea class="form-control" name="description" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>     
                            <select class='form-select' name="sale_status">
                                <option value="Pre-Selling">Pre-Selling</option>
                                <option value="RFO">RFO</option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="min_price" class="form-control">
                                    <label for="">Minimum Price</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="max_price" class="form-control">
                                    <label for="">Maximum Price</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="">Unit Types</label>     
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='br1' id='add_1br'>
                                    <label class="form-check-label" for="">1BR</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='ph' id='add_ph'>
                                    <label class="form-check-label" for="">PH</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='br2' id='add_2br'>
                                    <label class="form-check-label" for="">2BR</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='studio' id='add_studio'>
                                    <label class="form-check-label" for="">Studio</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='br3' id='add_3br'>
                                    <label class="form-check-label" for="">3BR</label>
                                </div>
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
                <h5 class="modal-title">Update Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/properties/update" method="post" enctype="multipart/form-data" id="updForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Logo</label>     
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" id='name' class="form-control">
                            <label for="">Name</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="location" id='location' class="form-control">
                            <label for="">Location</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>     
                            <textarea class="form-control" name="description" id='description' cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>     
                            <select class='form-select' name="sale_status" id='sale_status'>
                                <option value="Pre-Selling">Pre-Selling</option>
                                <option value="RFO">RFO</option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="min_price" id='min_price' class="form-control">
                                    <label for="">Minimum Price</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="max_price" id='max_price' class="form-control">
                                    <label for="">Maximum Price</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="">Unit Types</label>     
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='br1' id='upd_1br'>
                                    <label class="form-check-label" for="">1BR</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='ph' id='upd_ph'>
                                    <label class="form-check-label" for="">Penthouse</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='br2' id='upd_2br'>
                                    <label class="form-check-label" for="">2BR</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='studio' id='upd_studio'>
                                    <label class="form-check-label" for="">Studio</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='br3' id='upd_3br'>
                                    <label class="form-check-label" for="">3BR</label>
                                </div>
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
                <h5 class="modal-title">Delete Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Property?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/amenities/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/properties.js') }}"></script>
@endsection
    