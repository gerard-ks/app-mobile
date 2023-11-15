@extends('admin.base')
@section('title', 'chauffeur')
@section('content')

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
                        <a class="active" href="#">Chauffeur</a>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer un conducteur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('creerChauffeur') }}" method="post" class="vstack gap-3">
                            @csrf
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control">
                                @error('nom')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control">
                                @error('prenom')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dateNaissance">Date de naissance</label>
                                <input type="date" name="dateNaissance" id="dateNaissance" class="form-control">
                                @error('dateNaissance')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="numeroPieceIdentite">Numero de Piece</label>
                                <input type="text" name="numeroPieceIdentite" id="numeroPieceIdentite" class="form-control">
                                @error('numeroPieceIdentite')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telephone">telephone</label>
                                <input type="number" name="telephone" id="telephone" class="form-control">
                                @error('telephone')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" name="adresse" id="adresse" class="form-control">
                                @error('adresse')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="salaire">Salaire</label>
                                <input type="number" name="salaire" id="salaire" class="form-control">
                                @error('salaire')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" name="username" id="username" class="form-control">
                                @error('username')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
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
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">DateNaissance</th>
                        <th scope="col">NumeroPiece</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Salaire</th>
                        <th scope="col">NomUtilisateur</th>
                        <th scope="col">Attribution</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($chauffeurs as $chauffeur)
                    <tr>

                            <th scope="row">{{ $chauffeur->id }}</th>
                            <td>{{ $chauffeur->nom }}</td>
                            <td>{{ $chauffeur->prenom }}</td>
                            <td>{{ date('d-m-Y', strtotime($chauffeur->date2Naissance )) }}</td>
                            <td>{{ $chauffeur->numeroPiece }}</td>
                            <td>{{ $chauffeur->telephone }}</td>
                            <td>{{ $chauffeur->adresse }}</td>
                            <td>{{ $chauffeur->salaire }}</td>
                            <td>{{ $chauffeur->nomUtilisateur }}</td>
                            <td>
                                @if ($chauffeur->hasVehicule == false)
                                    Aucune
                                @else
                                    deja attribue
                                @endif
                            </td>
                        <td>
                            <p>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmationModal" class="text-danger">
                                    Supprimer
                                </a>
                            </p>

                            <!-- Modal de confirmation -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer l'élément {{ $chauffeur->nom }} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form method="POST" action="#">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


    </main>
@endsection
