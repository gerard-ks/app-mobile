<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChauffeurVehicule
 * 
 * @property int $id
 * @property int $chauffeur_id
 * @property int $vehicule_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Chauffeur $chauffeur
 * @property Vehicule $vehicule
 * @property Collection|Carburant[] $carburants
 * @property Collection|Localisation[] $localisations
 * @property Collection|Maintenance[] $maintenances
 *
 * @package App\Models
 */
class ChauffeurVehicule extends Model
{
	protected $table = 'chauffeur_vehicule';

	protected $casts = [
		'chauffeur_id' => 'int',
		'vehicule_id' => 'int'
	];

	protected $fillable = [
		'chauffeur_id',
		'vehicule_id'
	];

	public function chauffeur()
	{
		return $this->belongsTo(Chauffeur::class);
	}

	public function vehicule()
	{
		return $this->belongsTo(Vehicule::class);
	}

	public function carburants()
	{
		return $this->hasMany(Carburant::class);
	}

	public function localisations()
	{
		return $this->hasMany(Localisation::class);
	}

	public function maintenances()
	{
		return $this->hasMany(Maintenance::class);
	}
}
