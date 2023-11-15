@extends('admin.base')
@section('title', 'dashboard')
@section('content')
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Tableau de bord</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Tableau de bord</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="active" href="#">Accueil</a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check' ></i>
                <span class="text">
            <h3>{{ $totalVehicules }}</h3>
            <p>vehicules</p>
          </span>
            </li>
            <li>
                <i class='bx bxs-group' ></i>
                <span class="text">
            <h3>{{ $totalChauffeur }}</h3>
            <p>Chauffeurs</p>
          </span>
            </li>

        </ul>


        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Vehicules</h3>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th>Immatriculation</th>
                        <th>Marque</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicules as $vehicule)
                    <tr>
                        <td>
                            <p>{{ $vehicule->immatriculation }}</p>
                        </td>
                        <td>{{ $vehicule->marque }}</td>
                        @if ($vehicule->isAssign == true)
                        <td><span class="status pending">Indisponible</span></td>
                        @elseif ($vehicule->isAssign == false)
                        <td><span class="status completed">Disponible</span></td>
                        @endif

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="todo">
                <div class="head">
                    <h3>Chauffeurs</h3>
                </div>

                <ul class="todo-list">
                    @foreach ($chauffeurs as $chauffeur)
                    <li class="completed">
                        <p>{{ $chauffeur->nom }}</p>
                        <i class='bx bx-dots-vertical-rounded' ></i>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </main>
    <!-- MAIN -->
@endsection
