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
        <h2>Student Information Form</h2>
        {{-- @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach    
            </ul>            
        @endif --}}
        <form action={{route('insert.student')}} method="POST">
            @csrf
            <!-- Name input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <!-- Email input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <!-- Age input -->
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="text" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" id="age" name="age" min="0">
                <span class="text-danger">
                    @error('age')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <!-- City input -->
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <select name="" id="" class="form-control" name="city">
                    <option value="1">Peshawar</option>
                    <option value="2">Islamabad</option>
                    <option value="3">Karachi</option>
                    <option value="4">Quetta</option>
                    <option value="5">Lahore</option>
                </select>
                <span class="text-danger">
                    @error('city')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</body>
</html>