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
    <a href="/admin" class="btn btn-primary">Back</a>
    <a href="/admin/amenities/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Picture</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($amenities) > 0)
                @foreach ($amenities as $amenity)
                    <tr>
                        <td>{{ $amenity->name }}</td>
                        <td>{{ $amenity->type }}</td>
                        <td><img src="{{  asset('uploads/amenities/picture') }}/{{ $amenity->picture }}" alt=""></td>
                        <td><a href="/admin/amenities/edit/{{ $amenity->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/amenities/delete/{{ $amenity->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@section('scripts')
    @parent
@endsection
    