<!DOCTYPE html>
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
    <form action="/admin/amenities/add" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Name</label>     
            <input type="text" name="name">
        </div>

        <div>
            <label for="">Type</label>     
            <select name="type">
                <option value="Indoor">Indoor</option>
                <option value="Outdoor">Outdoor</option>
            </select>
        </div>

        <div>
            <label for="">Picture</label>     
            <input type="file" name="picture">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    