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
    <a href="/admin/videos/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($videos) > 0)
                @foreach ($videos as $video)
                    <tr>    
                        <td>{{ $video->code }}</td>
                        <td><a href="/admin/videos/edit/{{ $video->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/videos/delete/{{ $video->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
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
    