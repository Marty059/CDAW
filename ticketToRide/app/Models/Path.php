<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'paths';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ID_PATH',
        'CITY_1',
        'CITY_2',
        'LENGTH',
        'COLOR_1',
        'COLOR_2',
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
    protected $casts = [];
}
