<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carburant;
use App\Models\Chauffeur;
use App\Models\ChauffeurVehicule;
use App\Models\Localisation;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthDriverController extends Controller
{
    public function doLogin(Request $request)
    {

        $chauffeurDonne = $request->validate([
            'nomUtilisateur' => 'bail|required|between:5,20|alpha',
            'motPasse' => 'required|min:4'
        ]);


        $chauffeur = Chauffeur::where("nomUtilisateur", $chauffeurDonne["nomUtilisateur"])->first();

        if (!$chauffeur) {
            return response(["message" => "Aucun chauffeur trouvé avec ce nom d'utilisateur."], 401);
        }

        if (!Hash::check($chauffeurDonne["motPasse"], $chauffeur->motPasse)) {
            return response(["message" => "Mot de passe incorrect."], 401);
        }

        $vehicules = $chauffeur->vehicules()
            ->where('isAssign', true)
            ->first()->immatriculation;

        $i =  $chauffeur->vehicules()
            ->where('isAssign', true)
            ->first()->id;

        $conduites = ChauffeurVehicule::where('vehicule_id', $i)->get();

        foreach($conduites as $conduite){
           $conduite_id = $conduite->chauffeur_id;
        }

        return response()->json([
            "chauffeur" => $chauffeur,
            "immatriculation" => $vehicules,
            "idVehicule" => $i,
            "idConduite" => $conduite_id,
            'token' => $chauffeur->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    public function addLocalisation(Request $request)
    {
        $localisationsDonne = $request->validate([
            'longitude' => 'required',
            'latitude' => 'required',
            'chauffeur_vehicule_id' => 'required'
        ]);

        // Création de la localisation associée au chauffeur_vehicule
        $localisation = new Localisation([
            "longitude" => $localisationsDonne["longitude"],
            "latitude" => $localisationsDonne["latitude"],
            "chauffeur_vehicule_id" => $localisationsDonne["chauffeur_vehicule_id"]
        ]);

        $localisation->save();

        return response(["message" => "Vos coordonnées ont été enregistrées."], 201);
    }

    public function addCarburant(Request $request) {
        $carburantDonne = $request->validate([
            'numeroFacture' => 'required',
            'nombreLitre' => 'required',
            'montantCarburant' => 'required',
            'chauffeur_vehicule_id' => 'required'
        ]);

        // Création du carburant associé au véhicule
        $carburant = new Carburant([
            "numeroFacture" => $carburantDonne["numeroFacture"],
            "nombreLitre" => $carburantDonne["nombreLitre"],
            "montantCarburant" => $carburantDonne["montantCarburant"],
            "chauffeur_vehicule_id" => $carburantDonne["chauffeur_vehicule_id"]
        ]);

        $carburant->save();

        return response(["message" => "Enregistré avec succès."], 201);
    }


    public function addMaintenance(Request $request)
    {
        $maintenanceDonne = $request->validate([
            'numeroFacture' => 'required',
            'reparation' => 'required',
            'montantMaintenance' => 'required',
            'chauffeur_vehicule_id' => 'required'
        ]);


        $maintenance = new Maintenance([
            "numeroFacture" => $maintenanceDonne["numeroFacture"],
            "reparation" => $maintenanceDonne["reparation"],
            "montantMaintenance" => $maintenanceDonne["montantMaintenance"],
            "chauffeur_vehicule_id" => $maintenanceDonne["chauffeur_vehicule_id"]
        ]);

        $maintenance->save();

        return response(["message" => "Enregistrer avec succes."], 201);
    }

}
