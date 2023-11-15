<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChauffeurController extends Controller
{
    public function index() {
        $chauffeurs = Chauffeur::all();
        return view('admin.views.chauffeur', ['chauffeurs' => $chauffeurs]);
    }

    public function doPost(Request $request)
    {
       $chauffeurDonnee =  $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'dateNaissance' => 'required',
            'numeroPieceIdentite' => 'required|string',
            'telephone' => 'required|numeric',
            'adresse' => 'required|string',
            'salaire' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required|min:4'
        ]);

       $chauffeur = new Chauffeur([
           'nom' => $chauffeurDonnee['nom'],
           'prenom' => $chauffeurDonnee['prenom'],
           'dateNaissance' => $chauffeurDonnee['dateNaissance'],
           'numeroPiece' => $chauffeurDonnee['numeroPieceIdentite'],
           'telephone' => $chauffeurDonnee['telephone'],
           'adresse' => $chauffeurDonnee['adresse'],
           'salaire' => $chauffeurDonnee['salaire'],
           'nomUtilisateur' => $chauffeurDonnee['username'],
           'motPasse' => Hash::make($chauffeurDonnee['password'])
       ]);

       $chauffeur->save();
       return to_route('chauffeur')->with('success', 'Le chauffeur a bien été enregistré');
    }

    public function deleteDriver(int $id){
        $chauffeur = Chauffeur::find($id);
        $chauffeur->delete();
        return to_route('chauffeur')->with('success', 'Le chauffeur a été supprimé');
    }
}
