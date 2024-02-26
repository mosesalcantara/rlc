<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/parking" class="btn btn-primary">Back</a>
    <form action="/admin/parking/add" method="post">
        @csrf   
        <div>
            <label for="">Rate</label>     
            <input type="text" name="rate">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</body>
</html>