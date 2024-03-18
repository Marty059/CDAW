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
    protected $table = 'lobbies';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ID_LOBBY',
        'MAX_PLAYERS',
        'IS_PRIVATE',
        'HAS_STARTED',
        'CREATION_DATE',
    ];

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
        'IS_PRIVATE' => 'boolean',
        'HAS_STARTED' => 'boolean',
        'CREATION_DATE' => 'datetime',
    ];
}
