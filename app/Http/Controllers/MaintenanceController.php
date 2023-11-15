<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\ChauffeurVehicule;

class MaintenanceController extends Controller
{
    public function index(){
        $vehicules = Vehicule::all();
       return view('admin.views.maintenance', [
        'vehicules' => $vehicules
       ]);
    }

    public function rechercheMaintenance(Request $request){
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
                    $carburants = Maintenance::where('chauffeur_vehicule_id', $conduite->id)->get();
                }

                $v = Vehicule::where('id', $conduite->vehicule_id)->get();

                return view('admin.views.maintenance', [
                    'carbu' => $carburants,
                    'vehi' => $v,
                    'vehicules' => $vehicules
                ]);
        }

        $conduites = ChauffeurVehicule::where('vehicule_id', $inputIdVehicule)->get();


        foreach ($conduites as $conduite) {
            $carburants = Maintenance::where('chauffeur_vehicule_id', $conduite->id)->get();
            $montantTotal = Maintenance::where('chauffeur_vehicule_id', $conduite->id)->sum('montantMaintenance');
        }

        $v = Vehicule::where('id', $conduite->vehicule_id)->get();

        return view('admin.views.maintenance', [
            'carbu' => $carburants,
            'vehi' => $v,
            'vehicules' => $vehicules,
            'montant' => $montantTotal,
        ]);
    }
}
