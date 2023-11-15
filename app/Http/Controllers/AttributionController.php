<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributionRequest;
use App\Models\Chauffeur;
use App\Models\ChauffeurVehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AttributionController extends Controller
{
    public function index()
    {

        $chauffeurs = Chauffeur::where('hasVehicule', false)->get();
        $vehicules = Vehicule::where('isAssign', false)->get();

       $chauffeurHasVehicule =  Chauffeur::where('hasVehicule', true)->get();
       $vehiculeIsAssign =  Chauffeur::where('hasVehicule', true)->get();

        return view('admin.views.attribution', [
            'chauffeurs' => $chauffeurs,
            'vehicules' => $vehicules,
            'chauffeurHasVehicule' => $chauffeurHasVehicule,
            'vehiculeIsAssign' => $vehiculeIsAssign
        ]);
    }

    public function attribuer(AttributionRequest $request)
    {
        // Récupère les modèles Chauffeur et Vehicule
        $chauffeurs = Chauffeur::find($request->chauffeurs);
        $vehicules = Vehicule::find($request->vehicules);

        // Boucle sur les chauffeurs
        foreach ($chauffeurs as $chauffeur) {
            // Vérifie si le chauffeur a déjà un véhicule attribué
            if (!$chauffeur->hasVehicule) {
                // Boucle sur les véhicules
                foreach ($vehicules as $vehicule) {
                    // Vérifie si le véhicule n'est pas déjà attribué
                    if (!$vehicule->isAssign) {
                        // Attribue le véhicule au chauffeur
                        $chauffeur->hasVehicule = true;
                        $chauffeur->save();

                        $chauffeur->vehicules()->sync([$vehicule->id]);

                        // Marque le véhicule comme attribué
                        $vehicule->isAssign = true;
                        $vehicule->save();
                    } else {
                        return redirect()->route('attribution')->with('failed', "L'attribution est impossible");
                    }
                }
            } else {
                return redirect()->route('attribution')->with('failed', "L'attribution est impossible pour le chauffeur déjà attribué");
            }
        }

        // Si tout s'est bien déroulé, retourne avec un message de succès
        return redirect()->route('attribution')->with('success', "L'attribution a bien été effectuée");
    }
}
