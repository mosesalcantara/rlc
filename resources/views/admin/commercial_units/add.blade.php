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
    <a href="/admin/commercial" class="btn btn-primary">Back</a>
    <form action="/admin/commercial/add" method="post">
        @csrf   
        <div>
            <label for="">Retail ID</label>     
            <input type="text" name="retail_id">
        </div>

        <div>
            <label for="">Building</label>     
            <input type="text" name="building">
        </div>

        <div>
            <label for="">Size</label>     
            <input type="text" name="size">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    