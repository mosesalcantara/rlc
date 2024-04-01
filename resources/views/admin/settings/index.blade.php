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
            <div class="col">
                <h5 class="mb-3">Settings</h5>

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

                    <div class="row">
                        <div class="col d-flex align-items-center justify-content-end">
                            <input type="hidden" value="0" name="upd_id" id="upd_id">
                            <input type="submit" class="btn btn-primary mr-2" value="Save">
                            <button type="button" class="btn btn-outline-secondary" onclick="get_upd_id()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/admin/settings.js') }}"></script>
@endsection
    