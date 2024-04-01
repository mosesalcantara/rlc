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
                <h5 class="mb-3">About Us</h5>

                <form action="/admin/about/update" method="post" enctype="multipart/form-data" id="updForm">
                    <div class="form-floating mb-3">
                        <input type="text" name="heading_title" id="heading_title" class="form-control">
                        <label for="">Heading Title</label>     
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Heading Image</label>     
                        <input type="file" name="heading_image" id='heading_image' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>     
                        <textarea class="form-control" name="description" id='description' cols="30" rows="5"></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xxl-6">
                            <div class="form-floating">
                                <input type="text" name="tagline_title" id='tagline_title' class="form-control">
                                <label for="">Tagline Title</label>     
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div class="form-floating">
                                <input type="text" name="tagline" id='tagline' class="form-control">
                                <label for="">Tagline</label>     
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xxl-6">
                            <div class="form-floating">
                                <input type="text" name="video_code" id='video_code' class="form-control">
                                <label for="">Video Code</label>     
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div class="form-floating">
                                <input type="text" name="video_title" id='video_title' class="form-control">
                                <label for="">Video Title</label>     
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Video Description</label>     
                        <textarea class="form-control" name="video_description" id='video_description' cols="30" rows="5"></textarea>
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

    <script src="{{ asset('js/admin/about_items.js') }}"></script>
@endsection
    