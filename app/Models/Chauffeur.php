<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Chauffeur
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property Carbon $dateNaissance
 * @property string $numeroPiece
 * @property string $telephone
 * @property string $adresse
 * @property int $salaire
 * @property string $nomUtilisateur
 * @property string $motPasse
 * @property bool $hasVehicule
 * @property Carbon|null $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|Vehicule[] $vehicules
 *
 * @package App\Models
 */
class Chauffeur extends Model
{
    use HasApiTokens;
	protected $table = 'chauffeurs';

	protected $casts = [
		'dateNaissance' => 'datetime',
		'salaire' => 'int',
		'hasVehicule' => 'bool'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'dateNaissance',
		'numeroPiece',
		'telephone',
		'adresse',
		'salaire',
		'nomUtilisateur',
		'motPasse',
		'hasVehicule'
	];

	public function vehicules()
	{
		return $this->belongsToMany(Vehicule::class)
					->withPivot('id')
					->withTimestamps();
	}
}
