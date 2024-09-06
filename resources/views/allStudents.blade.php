<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Students</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <br>
                <h1>All Students</h1>
                <a class="btn btn-success btn-sm mb-3" href={{route('add.form')}}>Add New</a>
                <br><br>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>View</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->age }}</td>
                            <td>{{ $item->cname }}</td>
                            <td><a class="btn btn-primary btn-sm" href={{ route('view.student', $item->id) }}>Details</a></td>
                            <td><a class="btn btn-danger btn-sm" href={{ route('delete.student', $item->id) }}>Delete</a></td>
                            <td><a class="btn btn-warning btn-sm" href={{ route('update.form', $item->id) }}>Update</a></td>
                        </tr>
                    @endforeach
                </table>
                {{-- <div class="mt-5">
                    {{ $data->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</body>
</html>