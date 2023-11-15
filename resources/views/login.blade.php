<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="page de connexion">
    <title>Connexion</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backoffice/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('backoffice/signin.css') }}" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin">
    <form action="{{route('connecting')}}" method="post">
        @csrf
        <img class="mb-4" src="{{ asset('assets/car-locator.svg') }}" alt="" width="120" height="120">
        <h1 class="h3 mb-3 fw-normal">Veuillez vous identifier</h1>

        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
    </form>
</main>
</body>
</html>
