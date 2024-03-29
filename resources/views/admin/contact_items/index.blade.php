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
                <h1 class="h3 mb-0 text-dark">Contact Us Items</h1>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Item
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
                <h5 class="modal-title">Add Contact Us Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/contact/add" method="post" enctype="multipart/form-data" id="addForm">         
                        <div class="form-floating mb-3">
                            <input type="text" name="heading_title" class="form-control">
                            <label for="">Heading Title</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Heading Image</label>     
                            <input type="file" name="heading_image" class="form-control">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="title" class="form-control">
                            <label for="">Title</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="subtitle" class="form-control">
                            <label for="">Subtitle</label>     
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
                        <div class="form-floating mb-3">
                            <input type="text" name="heading_title" id='heading_title' class="form-control">
                            <label for="">Heading Title</label>     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Heading Image</label>     
                            <input type="file" name="heading_image" id='heading_image' class="form-control">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="title" id='title' class="form-control">
                            <label for="">Title</label>     
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="subtitle" id='subtitle' class="form-control">
                            <label for="">Subtitle</label>     
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
                <h5 class="modal-title">Delete Contact Us Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Contact Us Item?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/contact/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/contact_items.js') }}"></script>
@endsection
    