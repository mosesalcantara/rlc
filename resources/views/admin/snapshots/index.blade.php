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
    <a href="/admin/snapshots/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($snapshots) > 0)
                @foreach ($snapshots as $snapshot)
                    <tr>
                        <td><img src="{{  asset('uploads/residential_units/snapshots') }}/{{ $snapshot->picture }}" alt=""></td>
                        <td>{{ $snapshot->unit_id }}</td>
                        <td><a href="/admin/snapshots/edit/{{ $snapshot->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/snapshots/delete/{{ $snapshot->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
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
    