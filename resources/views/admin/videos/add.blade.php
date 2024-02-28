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
    <a href="/admin/videos" class="btn btn-primary">Back</a>
    <form action="/admin/videos/add" method="post">
        @csrf   
        <div>
            <label for="">Code</label>     
            <input type="text" name="code">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    