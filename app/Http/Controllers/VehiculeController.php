<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class VehiculeController extends Controller
{
    public function vehicule()
    {
        $vehicules = Vehicule::all();
       return view('admin.views.vehicule', compact('vehicules'));
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('isFree');

        $vehicule = Vehicule::find($id);

        $vehicule->isFree =  $status;

        $vehicule->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function creerVehicule(Request $request){
        $vehiculeDonnee = $request->validate([
            'immatriculation' => 'required|string',
            'puissance' => 'required|numeric',
            'couleur' => 'required|string',
            'marque' => 'required|string',
            'anneeCirculation' => 'required'
        ]);

        $vehicule = new Vehicule([
            'immatriculation' => $vehiculeDonnee['immatriculation'],
            'puissance' => $vehiculeDonnee['puissance'],
            'couleur' => $vehiculeDonnee['couleur'],
            'marque' => $vehiculeDonnee['marque'],
            'anneeCirculation' => $vehiculeDonnee['anneeCirculation']
        ]);

        $vehicule->save();

        return redirect()->route('vehicule');
    }

}
