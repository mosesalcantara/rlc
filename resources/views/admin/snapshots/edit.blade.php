<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($data['snapshot'] as $item)
    <form action="/admin/snapshots/edit/{{ $item['id'] }}" method="post" enctype="application/x-www-form-urlencoded">
        @csrf
        <div>
            <label for="">Picture</label>     
            <input type="file" name="picture" value="{{ $item['picture'] }}">
        </div>

        <div>
            <label for="">Residential Unit</label>     
            <select name="residential_unit_id">
                @foreach ($data['r_units'] as $r_unit)
                    <option value="{{ $r_unit->id }}" {{ $r_unit->id == $item['residential_unit_id'] ? "selected" : "" }}>{{ $r_unit->unit_id }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <input type="submit" value="Update">
            <button>
                <a href="/admin/snapshots">Cancel</a>
            </button>
        </div>
    </form>
    @endforeach
</body>
</html>