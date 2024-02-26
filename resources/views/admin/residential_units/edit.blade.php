<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/residential" class="btn btn-primary">Back</a>
    <form action="/admin/residential/edit/{{ $r_unit->id }}" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Unit ID</label>     
            <input type="text" name="unit_id" value="{{ $r_unit->unit_id }}">
        </div>

        <div>
            <label for="">Building</label>     
            <input type="text" name="building" value="{{ $r_unit->building }}">
        </div>

        <div>
            <label for="">Unit Type</label>     
            <select name="type">
                <option value="1br">1 Bedroom</option>
                <option value="2br">2 Bedrooms</option>
                <option value="3br">3 Bedrooms</option>
                <option value="ph">Penthouse</option>
                <option value="studio">Studio</option>
            </select>
        </div>

        <div>
            <label for="">Area</label>     
            <input type="number" name="area" value="{{ $r_unit->area }}">
        </div>

        <div>
            <label for="">Monthly Rate</label>     
            <input type="text" name="rate" value="{{ $r_unit->rate }}">
        </div>

        <div>
            <label for="">Unit Status</label>     
            <select name="status">
                <option value="not-furnished">Not Furnished</option>
                <option value="semi-furnished">Semi-furnished</option>
                <option value="fully-furnished">Fully-furnished</option>
            </select>
        </div>

        <div>
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
</body>
</html>