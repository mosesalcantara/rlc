<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/admin/snapshots/edit/{{ $snapshot->id }}" method="post" enctype="application/x-www-form-urlencoded">
        @csrf
        <div>
            <label for="">Picture</label>     
            <input type="file" name="picture" value="{{ $snapshot->picture }}">
        </div>

        <div>
            <label for="">Residential Unit</label>     
            <input type="text" name="residential_unit_id" value="{{ $snapshot->residential_unit_id }}">
        </div>

        <div>
            <input type="submit" value="Update">
            <button>
                <a href="/admin/snapshots">Cancel</a>
            </button>
        </div>
    </form>
</body>
</html>