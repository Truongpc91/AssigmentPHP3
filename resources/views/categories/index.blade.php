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
    <title>List Category</title>
</head>

<body>
    <h1>List Category</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-secondary">Add New Category</a>

    @if (session('msg'))
        <h2>{{ session('msg') }}</h2>
    @endif

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>CREATED AT</th>
                <th>UPDATED AT</th>
                <th style="width: 25%">ACTION</th>
            </tr>
        </thead>
        @foreach ($data as $item)
            {{-- @dd($item) --}}
            <tr>
                <td>{{ $item->id }}</td>
                <td style="width: 15%">{{ $item->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td style="width: 25%" class="d-flex">
                    <a href="{{ route('categories.show', $item) }}" class="btn btn-warning">Show</a>
                    <a href="{{ route('categories.edit', $item) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('categories.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button 
                            class="btn btn-danger"
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {{-- Phân trang --}}
    {{ $data->links() }}
</body>

</html>
