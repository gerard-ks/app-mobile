<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index() {

        $totalChauffeur = Chauffeur::count();
        $totalVehicules = Vehicule::count();

        $chauffeurs = Chauffeur::all();
        $vehicules = Vehicule::all();

        return view('admin.views.main', [
            'totalChauffeur' => $totalChauffeur,
            'totalVehicules' => $totalVehicules,
            'chauffeurs' => $chauffeurs,
            'vehicules' => $vehicules
        ]);
     }

}
