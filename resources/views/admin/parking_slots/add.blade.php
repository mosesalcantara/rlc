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
    <a href="/admin/parking" class="btn btn-primary">Back</a>
    <form action="/admin/parking/add" method="post">
        @csrf   
        <div>
            <label for="">Rate</label>     
            <input type="text" name="rate">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    