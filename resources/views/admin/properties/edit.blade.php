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
    <form action="/admin/properties/edit/{{ $property->id }}" method="post" enctype="application/x-www-form-urlencoded">
        @csrf
        <div>
            <label for="">Logo</label>     
            <input type="file" name="logo" value="{{ $property->logo }}">
        </div>
        <div>
            <label for="">Name</label>
            <input type="text" name='name' value="{{ $property->name }}"/>
        </div>
        <div>
            <label for="">Location</label>
            <input type="text" name='location' value="{{ $property->location }}"/>
        </div>
        <div>
            <label for="">Description</label>
            <textarea name="description" cols="30" rows="5">{{ $property->description }}</textarea>
        </div>
        <div>
            <input type="submit" value="Update">
            <button>
                <a href="/admin/properties">Cancel</a>
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    @parent
@endsection
    