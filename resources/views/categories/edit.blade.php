<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit Category : {{ $category->name }}</title>
</head>

<body>
    <h1>Edit Category : {{ $category->name }}</h1>

    @if (session('msg'))
        <h2>{{ session('msg') }}</h2>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="post" class="form-control">
        @csrf
        {{-- Sửa phương thức  --}}
        @method('PUT')
        <div class="">
            <label for="label-control">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}">
        </div>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</body>

</html>
