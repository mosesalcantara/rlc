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
    <a href="/admin/amenities" class="btn btn-primary">Back</a>
    <form action="/admin/amenities/edit/{{ $amenity->id }}" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Name</label>     
            <input type="text" name="name" value="{{ $amenity->name }}">
        </div>

        <div>
            <label for="">Type</label>     
            @if ($amenity->type == 'indoor')
            <select name="type">
                <option value="indoor" selected>Indoor</option>
                <option value="outdoor">Outdoor</option>
            </select>
            @else
            <select name="type">
                <option value="indoor" selected>Indoor</option>
                <option value="outdoor" selected>Outdoor</option>
            </select>
            @endif
        </div>

        <div>
            <label for="">Picture</label>     
            <input type="file" name="picture" value="{{ $amenity->picture }}">
        </div>

        <div>
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    