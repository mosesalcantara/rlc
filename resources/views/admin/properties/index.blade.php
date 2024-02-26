<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        img {
            width: 5vw;
            height: 5vh;
        }
    </style>
</head>
<body>
    <a href="/admin" class="btn btn-primary">Back</a>
    <a href="/admin/properties/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($properties) > 0)
                @foreach ($properties as $property)
                    <tr>
                        <td><img src="{{  asset('uploads/properties/logo/$property->logo') }}" alt=""></td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->location }}</td>
                        <td>{{ $property->description }}</td>
                        <td><a href="/admin/properties/edit/{{ $property->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/properties/delete/{{ $property->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>