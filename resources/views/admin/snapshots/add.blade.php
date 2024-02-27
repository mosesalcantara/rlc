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
            <input type="text" name="residential_unit_id">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</body>
</html>