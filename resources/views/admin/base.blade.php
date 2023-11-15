<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
</head>
<body>
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <i class='bx bx-current-location'></i>
        <span class="text">Administration</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="{{ route('dashboard') }}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="{{ route('chauffeur') }}">
                <i class='bx bxs-user'></i>
                <span class="text">Chauffeur</span>
            </a>
        </li>
        <li>
            <a href="{{ route('vehicule') }}">
                <i class='bx bxs-taxi'></i>
                <span class="text">Vehicule</span>
            </a>
        </li>
        <li>
            <a href="{{ route('attribution') }}">
                <i class='bx bx-log-in'></i>
                <span class="text">Attribution</span>
            </a>
        </li>
        <li>
            <a href="{{ route('carburant') }}">
                <i class='bx bxs-gas-pump'></i>
                <span class="text">Carburant</span>
            </a>
        </li>
        <li>
            <a href="{{ route('maintenance') }}">
                <i class='bx bxs-car-mechanic'></i>
                <span class="text">Maintenance</span>
            </a>
        </li>
        <li>
            <a href="{{ route('localisation') }}">
                <i class='bx bx-trip'></i>
                <span class="text">Localisation</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <form action="{{ route('disconnect') }}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-outline-danger">Se deconnecter</button>
            </form>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->



<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i id="toggleButton" class='bx bx-menu' ></i>
    </nav>
    <!-- NAVBAR -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    @yield('content')
</section>
<!-- CONTENT -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('backoffice/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
</body>
</html>
