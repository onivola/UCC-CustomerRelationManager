<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--<link rel="stylesheet" href="{{ asset('css/home.css') }}">-->

    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" />
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.6.1.min.js') }}"></script>

    <link href="{{ asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/regular.css')}}" rel="stylesheet">
    <script src="{{ asset('js/preremplissage/main.js') }}"></script>
    <script src="{{ asset('jquery/validation/lead_agent_validation.js') }}"></script>
</head>
<body>

    <table class="table">
        <thead>
            <tr>
                <th scope="row">id</th>
                <td>Nom agent</td>
                <td>Nom commercial</td>
                <td>Numero de siret</td>
                <td>date de creation</td>

              </tr>
        </thead>
        <tbody>

            @foreach ($leads as $lead )
                <tr>
                    <td>{{ $lead -> id }}</td>
                    <td>{{ $lead -> Agent}}</td>
                    <td>{{ $lead -> Noms_commerciaux }}</td>
                    <td>{{ $lead -> Numero_SIRET }}</td>
                    <td>{{ $lead -> created_at -> format('Y-m-d') }}</td>
                    <td>
                        <a href="/update-etudiant/{{ $lead -> id }}" class="btn btn-info">Update</a>
                        <a href="/delete-lead/{{$lead->id}}" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce lead ?')">Delete</a>

                    </td>
                </tr>
            @endforeach
      </table>
</body>
</html>
