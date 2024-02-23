<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="/admin/navbar/edit/{{ $nav_item->id }}" method="post">
        @csrf
        <div class="form-floating mb-4">
            <input type="text" id="title" name='title' value="{{ $nav_item->title }}" class="form-control form-control-lg" />
            <label class="form-label" for="title">Title</label>
        </div>
        <div class="form-floating mb-4">
            <input type="number" id="order" name='order' value="{{ $nav_item->order }}" class="form-control form-control-lg" />
            <label class="form-label" for="order">Order</label>
        </div>
        <div>
            <input type="submit" value="Update" class="btn btn-primary">
            <button class='btn btn-danger'>
                <a href="/admin/navbar">Cancel</a>
            </button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>