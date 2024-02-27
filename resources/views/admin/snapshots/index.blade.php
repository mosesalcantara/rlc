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
</body>
</html>