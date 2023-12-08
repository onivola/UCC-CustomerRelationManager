<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laravel 10 Generate PDF Example</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" />
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.6.1.min.js') }}"></script>
</head>
<body>
    <h1>title</h1>
    <p>data</p>
    <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
        Sed animi tempore officiis. Rerum placeat minus obcaecati ab
        et nemo tempore, distinctio deserunt quas earum quod voluptas
        reprehenderit aspernatur dignissimos autem!
    </p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user -> id }}</td>
                    <td>{{ $user -> name }}</td>
                    <td>{{ $user -> email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
