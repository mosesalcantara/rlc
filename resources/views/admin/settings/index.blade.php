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
                <h1 class="h3 mb-0 text-dark">Setting</h1>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-target="#addModal" data-bs-toggle="modal">
                    <i class="fa-solid fa-plus"></i>
                    Add Setting
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
                <h5 class="modal-title">Add Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/settings/add" method="post" enctype="multipart/form-data" id="addForm">         
                        <div class="mb-3">
                            <label for="" class="form-label">Logo</label>     
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="office" class="form-control">
                                    <label for="">Office</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="email" class="form-control">
                                    <label for="">Email</label>     
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="address" class="form-control">
                            <label for="">Address</label>     
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="telephone" class="form-control">
                                    <label for="">Telephone</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="mobile" class="form-control">
                                    <label for="">Mobile</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="messenger" class="form-control">
                                    <label for="">Messsenger Link</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="messenger_text" class="form-control">
                                    <label for="">Messenger Text</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="telegram" class="form-control">
                                    <label for="">Telegram Link</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="telegram_text" class="form-control">
                                    <label for="">Telegram Text</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="facebook" class="form-control">
                                    <label for="">Facebook</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="twitter" class="form-control">
                                    <label for="">Twitter</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">  
                                <div class="form-floating mb-3">
                                    <input type="text" name="instagram" class="form-control">
                                    <label for="">Instagram</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="youtube" class="form-control">
                                    <label for="">YouTube</label>     
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
                <h5 class="modal-title">Update Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/settings/update" method="post" enctype="multipart/form-data" id="updForm">
                        <div class="mb-3">
                            <label for="" class="form-label">Logo</label>     
                            <input type="file" name="logo" id='logo' class="form-control">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="office" id='office' class="form-control">
                                    <label for="">Office</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="email" id='email' class="form-control">
                                    <label for="">Email</label>     
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="address" id='address' class="form-control">
                            <label for="">Address</label>     
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="telephone" id='telephone' class="form-control">
                                    <label for="">Telephone</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="mobile" id='mobile' class="form-control">
                                    <label for="">Mobile</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="messenger" id='messenger' class="form-control">
                                    <label for="">Messsenger Link</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="messenger_text" id='messenger_text' class="form-control">
                                    <label for="">Messenger Text</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="telegram" id='telegram' class="form-control">
                                    <label for="">Telegram Link</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="telegram_text" id='telegram_text' class="form-control">
                                    <label for="">Telegram Text</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="facebook" id='facebook' class="form-control">
                                    <label for="">Facebook</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="twitter" id='twitter' class="form-control">
                                    <label for="">Twitter</label>     
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">  
                                <div class="form-floating mb-3">
                                    <input type="text" name="instagram" id='instagram' class="form-control">
                                    <label for="">Instagram</label>     
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="youtube" id='youtube' class="form-control">
                                    <label for="">YouTube</label>     
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
                <h5 class="modal-title">Delete Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this Setting?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/admin/settings/delete/" method="POST" id="delForm">
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

    <script src="{{ asset('js/admin/settings.js') }}"></script>
@endsection
    