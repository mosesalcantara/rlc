<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/amenities" class="btn btn-primary">Back</a>
    <form action="/admin/amenities/add" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Name</label>     
            <input type="text" name="name">
        </div>

        <div>
            <label for="">Type</label>     
            <select name="type">
                <option value="indoor">Indoor</option>
                <option value="outdoor">Outdoor</option>
            </select>
        </div>

        <div>
            <label for="">Picture</label>     
            <input type="file" name="picture">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</body>
</html>