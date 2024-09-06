<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Student Form</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Student Updation Form</h2>
        <form action={{route('update.student')}} method="POST">
            @csrf
            @method('PUT')
            <!-- Name input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
            </div>
            <input type="hidden" name="id" value="{{ $data->id }}">

            <!-- Email input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ $data->email }}">
            </div>

            <!-- Age input -->
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" id="age" name="age" min="0" required value="{{ $data->age }}">
            </div>

            <!-- City input -->
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" required value="{{ $data->city }}">
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
</body>
</html>