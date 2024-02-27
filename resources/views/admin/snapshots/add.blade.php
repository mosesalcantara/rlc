<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/snapshots" class="btn btn-primary">Back</a>
    <form action="/admin/snapshots/add" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Picture</label>     
            <input type="file" name="picture">
        </div>

        <div>
            <label for="">Residential Unit</label>     
            <select name="residential_unit_id">
                @if (count($r_units) > 0)
                @foreach ($r_units as $r_unit)
                    <option value="{{ $r_unit->id }}">{{ $r_unit->unit_id }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</body>
</html>