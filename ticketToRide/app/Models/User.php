<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory;
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'user';
    protected $primaryKey = 'id_user';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'username',
        'password',
        'email',
        'country',
        'is_admin',
        'is_banned',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Les attributs qui doivent être convertis en types de données spécifiques.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'is_banned' => 'boolean',
    ];
}
