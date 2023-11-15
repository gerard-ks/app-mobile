<?php

namespace App\Http\Controllers;

use App\Models\Carburant;
use App\Models\Chauffeur;
use App\Models\ChauffeurVehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class CarburantController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all();
        return view('admin.views.carburant', [
            'vehicules' => $vehicules
        ]);
    }

    public function rechercheCarburant(Request $request)
    {
        $vehicules = Vehicule::all();

        $form = $request->validate([
            'vehicule_id' => 'required',
            'de' => '',
            'a' => ''
        ]);

        $inputIdVehicule = $request->input('vehicule_id');
        $inputDe = $request->input('de');
        $inputA = $request->input('a');

        if (!empty($inputA) && !empty($inputA) && !empty($inputIdVehicule)) {
            $conduites = ChauffeurVehicule::where('vehicule_id', $inputIdVehicule)
                ->whereBetween('created_at', [$inputDe, $inputA])
                ->get();
                foreach ($conduites as $conduite) {
                    $carburants = Carburant::where('chauffeur_vehicule_id', $conduite->id)->get();
                }

                $v = Vehicule::where('id', $conduite->vehicule_id)->get();

                return view('admin.views.carburant', [
                    'carbu' => $carburants,
                    'vehi' => $v,
                    'vehicules' => $vehicules
                ]);
        }

        $conduites = ChauffeurVehicule::where('vehicule_id', $inputIdVehicule)->get();

        foreach ($conduites as $conduite) {
            $carburants = Carburant::where('chauffeur_vehicule_id', $conduite->id)->get();
            $montantTotal = Carburant::where('chauffeur_vehicule_id', $conduite->id)->sum('montantCarburant');
        }

        $v = Vehicule::where('id', $conduite->vehicule_id)->get();

        return view('admin.views.carburant', [
            'carbu' => $carburants,
            'vehi' => $v,
            'vehicules' => $vehicules,
            'montant' => $montantTotal
        ]);
    }
}
