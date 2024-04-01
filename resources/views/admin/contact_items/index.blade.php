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
                <h5 class="mb-3">Contact Us</h5>

                <form action="/admin/contact/update" method="post" enctype="multipart/form-data" id="updForm">
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

    <script src="{{ asset('js/admin/contact_items.js') }}"></script>
@endsection
    