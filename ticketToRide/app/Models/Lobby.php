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
        'name',
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

    public function getUsers(){
        // $id_users = Jouer::where('id_lobby', $this->id_lobby)->pluck('id_user');
        
        // $users = [];
        // foreach($id_users as $id_user){
        //     $user = User::where('id_user', $id_user)->first();
        //     if ($user) {
        //         $users[$id_user] = $user;
        //     }
        // }
        // return $users;

       return Jouer::join('user', 'jouer.id_user', '=', 'user.id_user')
            ->where('id_lobby', $this->id_lobby)
            ->get();
    }

    public function getUsersToString($id_user){
        $users = Jouer::join('user', 'jouer.id_user', '=', 'user.id_user')
            ->where('id_lobby', $this->id_lobby)
            ->get();
        
        $usersString = '';
        foreach($users as $index => $user){
            if ($user->id_user != $id_user) {
                $usersString .= $user->username;
                if ($index < count($users) - 1) {
                    $usersString .= ', ';
                }
            }
        }
        return $usersString;

    }
}
