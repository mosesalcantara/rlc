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
    <a href="/admin/properties" class="btn btn-primary">Back</a>
    <form action="/admin/properties/add" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Logo</label>     
            <input type="file" name="logo">
        </div>

        <div>
            <label for="">Name</label>     
            <input type="text" name="name">
        </div>

        <div>
            <label for="">Location</label>     
            <input type="text" name="location">
        </div>

        <div>
            <label for="">Description</label>     
            <textarea name="description" cols="30" rows="5"></textarea>
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    