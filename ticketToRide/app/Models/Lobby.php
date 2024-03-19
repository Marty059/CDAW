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
        'ID_Lobby',
        'Max_Players',
        'Is_Private',
        'Has_Started',
        'Has_Ended',
        'Creation_Date',
        'Start_Date',
        'Length',
        'ID_Creator',
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
        'Is_Private' => 'boolean',
        'Has_Started' => 'boolean',
        'Has_Ended' => 'boolean',
        'Creation_Date' => 'datetime',
        'Start_Date' => 'datetime',
        'Length' => 'double',
    ];
}
