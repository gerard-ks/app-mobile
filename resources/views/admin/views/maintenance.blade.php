@extends('admin.base')
@section('title', 'maintenance')
@section('content')
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Tableau de bord</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Tableau de bord</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Maintenance</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <form action="{{ route('rechercheMaintenance') }}" method="post" class="vstack gap-3">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <label for="vehicule">Vehicule</label>
                        <select name="vehicule_id" id="vehicule" class="form-control">
                            <option>Selectionner un vehicule</option>
                            @if (!empty($vehicules))
                            @foreach ($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}">{{ $vehicule->immatriculation }}</option>
                        @endforeach
                            @endif

                        </select>
                        @error('vehicule_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="de">De</label>
                        <input type="date" name="de" id="de" class="form-control">
                        @error('de')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="a">A</label>
                        <input type="date" name="a" id="a" class="form-control">
                        @error('a')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary">Rechercher</button>
                </div>
            </form>

            <!-- TABLEAU -->
            <div class="mt-4">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Chauffeur</th>
                            <th scope="col">Vehicule</th>
                            <th scope="col">Numero facture</th>
                            <th scope="col">Reparation</th>
                            <th scope="col">Montant maintenance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($carbu) && !empty($vehi))
                        @foreach ($carbu as $carbur)
                        <tr>
                            @foreach ($vehi as $v)
                            @foreach ($v->chauffeurs as $ch)
                            <td>{{$ch->nom}}</td>
                            @endforeach
                            <td>{{ $v->immatriculation  }}</td>
                            @endforeach
                            <td>{{ $carbur->numeroFacture }}</td>
                            <td>{{ $carbur->reparation }}</td>
                            <td>{{ $carbur->montantMaintenance }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if (!empty($montant))
                Total Montant Maintenance : {{ $montant }}
                @endif
            </div>
        </div>
    </main>

@endsection
