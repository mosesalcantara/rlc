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
                            <label for="" class="form-label">Picture</label>     
                            <input type="file" name="picture" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Residential Unit</label>  
                            <select name="residential_unit_id" id="add_residential_unit_id" class="form-select"></select>
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
                            <label for="" class="form-label">Picture</label>     
                            <input type="file" name="picture" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Residential Unit</label>  
                            <select name="residential_unit_id" id="upd_residential_unit_id" class="form-select"></select>
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

    <a href="/admin" class="btn btn-primary">Back</a>
    <a href="/admin/residential/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Property</th>
                <th>Location</th>
                <th>Unit ID</th>
                <th>Building</th>
                <th>Type</th>
                <th>Area</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($r_units) > 0)
                @foreach ($r_units as $r_unit)
                    <tr>    
                        <td>{{ $r_unit->name }}</td>
                        <td>{{ $r_unit->location }}</td>
                        <td>{{ $r_unit->unit_id }}</td>
                        <td>{{ $r_unit->building }}</td>
                        <td>{{ $r_unit->type }}</td>
                        <td>{{ $r_unit->area }}</td>
                        <td>{{ $r_unit->rate }}</td>
                        <td>{{ $r_unit->status }}</td>
                        <td><a href="/admin/residential/edit/{{ $r_unit->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/residential/delete/{{ $r_unit->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/admin/residential_units.js') }}"></script>
@endsection
    