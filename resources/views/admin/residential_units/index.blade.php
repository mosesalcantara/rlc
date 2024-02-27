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
    <a href="/admin/residential/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Property</th>
                <th>Location</th>
                <th>Unit ID</th>
                <th>Building</th>
                <th>Type</th>
                <th>Area</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($r_units) > 0)
                @foreach ($r_units as $r_unit)
                    <tr>    
                        <td>{{ $r_unit->name }}</td>
                        <td>{{ $r_unit->location }}</td>
                        <td>{{ $r_unit->unit_id }}</td>
                        <td>{{ $r_unit->building }}</td>
                        <td>{{ $r_unit->type }}</td>
                        <td>{{ $r_unit->area }}</td>
                        <td>{{ $r_unit->rate }}</td>
                        <td>{{ $r_unit->status }}</td>
                        <td><a href="/admin/residential/edit/{{ $r_unit->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/residential/delete/{{ $r_unit->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
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
    