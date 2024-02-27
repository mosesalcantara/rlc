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
    <form action="/admin/parking/edit/{{ $p_slot->id }}" method="post">
        @csrf   
        <div>
            <label for="">Rate</label>     
            <input type="text" name="rate" value="{{ $p_slot->rate }}">
        </div>

        <div>
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    