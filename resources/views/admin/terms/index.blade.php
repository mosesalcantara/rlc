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
                <h1 class="h3 mb-0 text-dark">Terms</h1>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Term
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
                <h5 class="modal-title">Add Term</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/terms/add" method="post" enctype="multipart/form-data" id="addForm">         
                        <div class="mb-3">
                            <label for="" class="form-label">Property</label>  
                            <select name="property_id" id="add_property_id" class="form-select"></select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Category</label>  
                            <select name="category" class="form-select">
                                <option value="Lease Term">Lease Term</option>
                                <option value="Payment Term">Payment Term</option>
                                <option value="Mode of Payment">Mode of Payment</option>
                                <option value="Documents">Documents</option>
                                <option value="Important Notice">Important Notice</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>     
                            <textarea class="form-control" name="description" cols="30" rows="5"></textarea>
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
                <h5 class="modal-title">Update Term</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/terms/update" method="post" enctype="multipart/form-data" id="updForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Property</label>  
                            <select name="property_id" id="upd_property_id" class="form-select"></select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Category</label>  
                            <select name="category" id='category' class="form-select">
                                <option value="Lease Term">Lease Term</option>
                                <option value="Payment Term">Payment Term</option>
                                <option value="Mode of Payment">Mode of Payment</option>
                                <option value="Documents">Documents</option>
                                <option value="Important Notice">Important Notice</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>     
                            <textarea class="form-control" name="description" id='description' cols="30" rows="5"></textarea>
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
                <h5 class="modal-title">Delete Term</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Term?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/terms/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/terms.js') }}"></script>
@endsection
    