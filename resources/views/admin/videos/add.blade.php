<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/videos" class="btn btn-primary">Back</a>
    <form action="/admin/videos/add" method="post">
        @csrf   
        <div>
            <label for="">Code</label>     
            <input type="text" name="code">
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</body>
</html>