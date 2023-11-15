<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehicule
 * 
 * @property int $id
 * @property string $immatriculation
 * @property int $puissance
 * @property string $couleur
 * @property string $marque
 * @property Carbon $anneeCirculation
 * @property bool $isAssign
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Chauffeur[] $chauffeurs
 *
 * @package App\Models
 */
class Vehicule extends Model
{
	protected $table = 'vehicules';

	protected $casts = [
		'puissance' => 'int',
		'anneeCirculation' => 'datetime',
		'isAssign' => 'bool'
	];

	protected $fillable = [
		'immatriculation',
		'puissance',
		'couleur',
		'marque',
		'anneeCirculation',
		'isAssign'
	];

	public function chauffeurs()
	{
		return $this->belongsToMany(Chauffeur::class)
					->withPivot('id')
					->withTimestamps();
	}
}
