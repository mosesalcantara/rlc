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
    <a href="/admin/commercial/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Retail ID</th>
                <th>Building</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($c_units) > 0)
                @foreach ($c_units as $c_unit)
                    <tr>    
                        <td>{{ $c_unit->retail_id }}</td>
                        <td>{{ $c_unit->building }}</td>
                        <td>{{ $c_unit->size }}</td>
                        <td><a href="/admin/commercial/edit/{{ $c_unit->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/commercial/delete/{{ $c_unit->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
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
    