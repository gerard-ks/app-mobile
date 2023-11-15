<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Maintenance
 * 
 * @property int $id
 * @property string $numeroFacture
 * @property string $reparation
 * @property int $montantMaintenance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $chauffeur_vehicule_id
 * 
 * @property ChauffeurVehicule $chauffeur_vehicule
 *
 * @package App\Models
 */
class Maintenance extends Model
{
	protected $table = 'maintenances';

	protected $casts = [
		'montantMaintenance' => 'int',
		'chauffeur_vehicule_id' => 'int'
	];

	protected $fillable = [
		'numeroFacture',
		'reparation',
		'montantMaintenance',
		'chauffeur_vehicule_id'
	];

	public function chauffeur_vehicule()
	{
		return $this->belongsTo(ChauffeurVehicule::class);
	}
}
