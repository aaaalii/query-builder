<h1>Student Detail</h1>

<h3>
    Name: {{ $data->name }} <br>
    Email: {{ $data->email }} <br>
    Age: {{ $data->age }} <br>
    City: {{ $data->city }} <br>
</h3>

<a href={{route('home')}}>Home</a>