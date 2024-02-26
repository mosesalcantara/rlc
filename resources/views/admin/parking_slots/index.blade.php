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
    <a href="/admin/parking/add">Add</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($p_slots) > 0)
                @foreach ($p_slots as $p_slot)
                    <tr>    
                        <td>{{ $p_slot->rate }}</td>
                        <td><a href="/admin/parking/edit/{{ $p_slot->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/parking/delete/{{ $p_slot->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>