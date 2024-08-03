<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create Category</title>
</head>

<body>
    <h1>Create New Category</h1>

    <form action="{{ route('categories.store') }}" method="post" class="form-control">
        @csrf
        <div class="">
            <label for="label-control">Name</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</body>

</html>
