<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" />
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.6.1.min.js') }}"></script>

    <link href="{{ asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/regular.css')}}" rel="stylesheet">
</head>
<body>
    <p>CQ</p>

        <!-- Bouton de déconnexion -->
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </button>
        </div>

        <!-- Formulaire de déconnexion -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
</body>
</html>
