@extends('admin.base')
@section('title', 'vehicule')

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
                        <a class="active" href="#">Vehicule</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary mt-3 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer un vehicule</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('creerVehicule') }}" method="post" class="vstack gap-3">
                            @csrf
                            <div class="form-group">
                                <label for="immatriculation">Immatriculation</label>
                                <input type="text" name="immatriculation" id="immatriculation" class="form-control">
                                @error('immatriculation')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="puissance">Puissance</label>
                                <input type="number" name="puissance" id="puissance" class="form-control">
                                @error('puissance')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur</label>
                                <input type="text" name="couleur" id="couleur" class="form-control">
                                @error('couleur')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="marque">Marque</label>
                                <input type="text" name="marque" id="marque" class="form-control">
                                @error('marque')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="anneeCirculation">Date de Circulation</label>
                                <input type="date" name="anneeCirculation" id="anneeCirculation" class="form-control">
                                @error('anneeCirculation')
                                    {{ $message }}
                                @enderror
                            </div>
                             <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- TABLEAU -->
        <div class="mt-4">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Immatriculation</th>
                        <th scope="col">Puissance</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Marque</th>
                        <th scope="col">anneeCirculation</th>
                        <th scope="col">Disponibilité</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicules as $vehicule)
                        <tr>
                            <th scope="row">{{ $vehicule->id }}</th>
                            <td>{{ $vehicule->immatriculation }}</td>
                            <td>{{ $vehicule->puissance }}</td>
                            <td>{{ $vehicule->couleur }}</td>
                            <td>{{ $vehicule->marque }}</td>
                            <td>{{ date('d-m-Y', strtotime($vehicule->anneeCirculation)) }}</td>
                            <td>
                                @if ($vehicule->isAssign == false)
                                Disponible
                            @else
                                Indisponible
                            @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

