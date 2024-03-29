<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jouer extends Model
{
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'jouer';
    public $incrementing = false;

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('id_lobby', $this->id_lobby)->where('id_user', $this->id_user);
    }

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_lobby',
        'id_user',
        'classement',
        'score',
    ];

    public $timestamps = false;

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Les attributs qui doivent être convertis en types de données spécifiques.
     *
     * @var array<string, string>
     */
    protected $casts = [];

      /**
     * Relation avec la table Lobby.
     */
    public function lobby()
    {
        return $this->belongsTo(Lobby::class, 'id_lobby');
    }

    
}
