<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carburant
 * 
 * @property int $id
 * @property string $numeroFacture
 * @property float $nombreLitre
 * @property int $montantCarburant
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $chauffeur_vehicule_id
 * 
 * @property ChauffeurVehicule $chauffeur_vehicule
 *
 * @package App\Models
 */
class Carburant extends Model
{
	protected $table = 'carburants';

	protected $casts = [
		'nombreLitre' => 'float',
		'montantCarburant' => 'int',
		'chauffeur_vehicule_id' => 'int'
	];

	protected $fillable = [
		'numeroFacture',
		'nombreLitre',
		'montantCarburant',
		'chauffeur_vehicule_id'
	];

	public function chauffeur_vehicule()
	{
		return $this->belongsTo(ChauffeurVehicule::class);
	}
}
