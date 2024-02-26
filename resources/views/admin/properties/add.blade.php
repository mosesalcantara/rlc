<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/admin/properties" class="btn btn-primary">Back</a>
    <form action="/admin/properties/add" method="post" enctype="multipart/form-data">
        @csrf   
        <div>
            <label for="">Logo</label>     
            <input type="file" name="logo">
        </div>

        <div>
            <label for="">Name</label>     
            <input type="text" name="name">
        </div>

        <div>
            <label for="">Location</label>     
            <input type="text" name="location">
        </div>

        <div>
            <label for="">Description</label>     
            <textarea name="description" cols="30" rows="5"></textarea>
        </div>

        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</body>
</html>