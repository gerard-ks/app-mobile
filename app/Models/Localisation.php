<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Localisation
 * 
 * @property int $id
 * @property float $longitude
 * @property float $latitude
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $chauffeur_vehicule_id
 * 
 * @property ChauffeurVehicule $chauffeur_vehicule
 *
 * @package App\Models
 */
class Localisation extends Model
{
	protected $table = 'localisations';

	protected $casts = [
		'longitude' => 'float',
		'latitude' => 'float',
		'chauffeur_vehicule_id' => 'int'
	];

	protected $fillable = [
		'longitude',
		'latitude',
		'chauffeur_vehicule_id'
	];

	public function chauffeur_vehicule()
	{
		return $this->belongsTo(ChauffeurVehicule::class);
	}
}
