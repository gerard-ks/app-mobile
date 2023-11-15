@extends('admin.base')
@section('title', 'Attribution')
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
                        <a class="active" href="#">Attribution</a>
                    </li>
                </ul>
            </div>
        </div>



        <form action="{{ route('attribuer') }}" method="post" class="vstack gap-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="chauffeur">Chauffeur</label>
                <select name="chauffeurs[]" id="chauffeur" class="form-control" multiple>
                    @foreach ($chauffeurs as $chauffeur)
                        <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }}</option>
                    @endforeach
                </select>
                @error('chauffeurs')
                    {{ $message }}
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicule">Vehicule</label>
                <select name="vehicules[]" id="vehicule" class="form-control" multiple>
                    @foreach ($vehicules as $vehicule)
                        <option value="{{ $vehicule->id }}">{{ $vehicule->immatriculation }}
                        </option>
                    @endforeach
                </select>
                @error('vehicules')
                    {{ $message }}
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                Attribuer
            </button>
        </form>

        <div class="mt-4">
            <table class="table">
    <thead class="table-dark">
        <tr>
            <th scope="col">Chauffeur</th>
            <th scope="col">Vehicule</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($chauffeurHasVehicule as $chauffeur)
        <tr>
            <td>{{ $chauffeur->nom }}</td>
            @foreach ($chauffeur->vehicules as $vehicule)
                <td>{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->pivot->created_at }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>


        </div>
    </main>
@endsection
