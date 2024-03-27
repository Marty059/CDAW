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
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    /**
     * Retourne le nombre de parties gagnées par l'utilisateur.
     *
     * @return int
     */
    public function partiesGagnees()
    {
        return Jouer::where('id_user', $this->id_user)
                    ->where('classement', 1)
                    ->count();
    }

    /**
     * Retourne le nombre de parties perdues par l'utilisateur.
     *
     * @return int
     */
    public function partiesPerdues()
    {
        return Jouer::where('id_user', $this->id_user)
                    ->where('classement', '>', 1)
                    ->count();
    }

    /**
     * Retourne le nombre total de parties jouées (terminées) par l'utilisateur.
     *
     * @return int
     */
    public function partiesJouees()
    {
        return Jouer::
                    join('lobby', 'jouer.id_lobby', '=', 'lobby.id_lobby')
                    ->where('id_user', $this->id_user)
                    ->where('lobby.has_ended', true)
                    ->count();
    }

    /**
     * Retourne le meilleur score de l'utilisateur.
     *
     * @return int|null
     */
    public function meilleurScore()
    {
        return Jouer::where('id_user', $this->id_user)
                    ->max('score');
    }

    
    /**
     * Relation avec les parties jouées par l'utilisateur.
     */
    public function historiquePartiesJouees()
    {
        return Jouer::join('lobby', 'jouer.id_lobby', '=', 'lobby.id_lobby')
                    ->where('jouer.id_user', $this->id_user)
                    ->where('lobby.has_ended', true)
                    ->get();
    }

    public function getUsername(int $id_user){
        $user = Jouer::where('id_user', $id_user)->first();
        if ($user) {
            return $user->username;
        } else {
            return null;
        }
    }
    
    
}
