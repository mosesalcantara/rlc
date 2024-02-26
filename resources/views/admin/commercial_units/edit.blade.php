<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/commercial" class="btn btn-primary">Back</a>
    <form action="/admin/commercial/edit/{{ $c_unit->id }}" method="post">
        @csrf   
        <div>
            <label for="">Retail ID</label>     
            <input type="text" name="retail_id" value="{{ $c_unit->retail_id }}">
        </div>

        <div>
            <label for="">Building</label>     
            <input type="text" name="building" value="{{ $c_unit->building }}">
        </div>

        <div>
            <label for="">Size</label>     
            <input type="text" name="size" value="{{ $c_unit->size }}">
        </div>

        <div>
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
</body>
</html>