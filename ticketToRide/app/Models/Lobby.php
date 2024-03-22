<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'lobby';
    protected $primaryKey = 'id_lobby';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_lobby',
        'max_players',
        'is_private',
        'has_started',
        'has_ended',
        'creation_date',
        'start_date',
        'duration',
        'id_createur',
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
    protected $casts = [
        'is_private' => 'boolean',
        'has_started' => 'boolean',
        'has_ended' => 'boolean',
        'creation_date' => 'datetime',
        'start_date' => 'datetime',
        'duration' => 'double',
    ];
}
