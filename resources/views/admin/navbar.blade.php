<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SB Admin 2 - Navbar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <a href="/admin" class="btn btn-primary">Back</a>
    <table class="tbl w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Order</th>
            </tr>
        </thead>
        <tbody>
            @if (count($nav_items) > 0)
                @foreach ($nav_items as $nav_item)
                    <tr>
                        <td>{{ $nav_item->id }}</td>
                        <td>{{ $nav_item->title }}</td>
                        <td>{{ $nav_item->order }}</td>
                        <td><a href="/admin/navbar/edit/{{ $nav_item->id }}" class="btn btn-primary">Edit</a>
                            <a href="/admin/navbar/delete/{{ $nav_item->id }}" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <form action="/admin/navbar/add" method="post">
        @csrf        
        <div class="form-floating mb-4 w-50">
            <input type="text" id="title" name='title' class="form-control form-control-lg" />
            <label class="form-label" for="title">Title</label>
        </div>
        <div class="form-floating mb-4 w-50">
            <input type="number" id="order" name='order' class="form-control form-control-lg" />
            <label class="form-label" for="order">Order</label>
        </div>
        <div>
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>