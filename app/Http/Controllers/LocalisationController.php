<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\ChauffeurVehicule;
use App\Models\Localisation;
use Illuminate\Http\Request;

class LocalisationController extends Controller
{
    public function index(){

        $chauffeurHasVehicule =  Chauffeur::where('hasVehicule', true)->get();

        return view('admin.views.localisation', [
            'chauffeurs' => $chauffeurHasVehicule
        ]);
    }

    public function rechercheLocalisation(Request $request) {
        $localisationsDonnee = $request->validate([
            'chauffeur_id' => 'required',
            'de' => '',
            'a' => ''
        ]);

        $chauffeurHasVehicule =  Chauffeur::where('hasVehicule', true)->get();

        $inputIdChauffeur = $request->input('chauffeur_id');
        $inputDe = $request->input('de');
        $inputA = $request->input('a');

        if (!empty($inputA) && !empty($inputA) && !empty($inputIdVehicule)) {
            $conduites = ChauffeurVehicule::where('chauffeur_id', $inputIdChauffeur)
                ->whereBetween('created_at', [$inputDe, $inputA])
                ->get();
                foreach ($conduites as $conduite) {
                    $localisations = Localisation::where('chauffeur_vehicule_id', $conduite->id)->get();
                }

                return view('admin.views.carburant', [
                    'localisations' => $localisations,
                    'chauffeurs' => $chauffeurHasVehicule
                ]);
        }



        $conduites = ChauffeurVehicule::where('chauffeur_id', $inputIdChauffeur)->get();



        foreach ($conduites as $conduite) {
            $localisations = Localisation::where('chauffeur_vehicule_id', $conduite->id)->get();
        }



        return view('admin.views.localisation', [
            'localisations' => $localisations,
            'chauffeurs' => $chauffeurHasVehicule
        ]);
    }
}
