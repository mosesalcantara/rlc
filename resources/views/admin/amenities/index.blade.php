<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                        <td><img src="{{  asset('uploads/amenities/picture') }}/{{ $property->logo }}" alt=""></td>
                        <td><a href="/admin/amenities/edit/{{ $amenity->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/amenities/delete/{{ $amenity->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>