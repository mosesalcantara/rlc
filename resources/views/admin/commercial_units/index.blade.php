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
                <h1 class="h3 mb-0 text-dark">Commercial Units</h1>
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
                  <h5 class="modal-title">Add Commercial Unit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/commercial/add" method="post" id="addForm">
                        @csrf   
                        <div class="form-floating mb-3">  
                            <input type="text" name="retail_id" class="form-control">
                            <label for="">Retail ID</label>   
                        </div>
                
                        <div class="form-floating mb-3"> 
                            <input type="text" name="building" class="form-control">
                            <label for="">Building</label>    
                        </div>
                
                        <div class="form-floating mb-3">  
                            <input type="text" name="size" class="form-control">
                            <label for="">Size</label>   
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
                  <h5 class="modal-title">Update Commercial Unit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/commercial/update" method="post" id="updForm">
                        @csrf   
                        <div class="form-floating mb-3">  
                            <input type="text" name="retail_id" id="retail_id" class="form-control">
                            <label for="">Retail ID</label>   
                        </div>
                
                        <div class="form-floating mb-3"> 
                            <input type="text" name="building" id="building" class="form-control">
                            <label for="">Building</label>    
                        </div>
                
                        <div class="form-floating mb-3">  
                            <input type="text" name="size" id='size' class="form-control">
                            <label for="">Size</label>   
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
                  <h5 class="modal-title">Delete Commercial Unit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Commercial Unit?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/commercial/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/commercial_units.js') }}"></script>
@endsection
    