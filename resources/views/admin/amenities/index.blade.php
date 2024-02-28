@extends('sections.admin.layout')

@section('title', 'Dashboard')
    
@section('links')
    @parent

    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('sidebar')
    @parent
@endsection

@section('main')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col mb-3">
                <h1 class="h3 mb-0 text-dark">Amenities</h1>
            </div>
            <div clas="col">
                <button type="button" class="btn btn-primary mb-3" onclick="window.location='/admin/amenities/add'">
                    <i class="fa-solid fa-plus"></i>
                    Add Amenity
                </button>
            </div>
        </div>
    </div>

    <div class="container tbl_div">
        <table class="table table-hover w-100" id="tbl_records">
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
                            <td><a href="/admin/amenities/edit/{{ $amenity->id }}" class="fa-solid fa-pen" title="Edit"></i></a>
                                <a href="/admin/amenities/delete/{{ $amenity->id }}" class="fa-solid fa-trash" title="Delete" onclick="return confirm('Delete?')"></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/admin/amenities.js') }}"></script>
@endsection
    