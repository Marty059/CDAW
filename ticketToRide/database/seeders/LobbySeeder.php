<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lobby;
use App\Models\User;
use Carbon\Carbon;

class LobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer tous les utilisateurs existants
        $users = User::all();

        foreach ($users as $user) {
            // Créer un lobby pour chaque utilisateur
            $lobby = new Lobby();
            $lobby->name = 'Lobby de ' . $user->username; // Nom du lobby
            $lobby->max_players = rand(2, 5); // Générer un nombre aléatoire entre 2 et 5 pour max_players
            $lobby->is_private = false; // Par défaut, le lobby n'est pas privé
            $lobby->password = bcrypt(''); // Par défaut, le lobby n'a pas de mot de passe
            $lobby->has_started = false; // Par défaut, le lobby n'a pas encore démarré
            $lobby->has_ended = true; // Par défaut, le lobby n'est pas encore terminé
            $lobby->creation_date = Carbon::now(); // Date de création du lobby
            $lobby->id_createur = $user->id_user; // L'utilisateur actuel est le créateur du lobby

            // Génération de la date de début et de la durée du lobby (pour l'exemple, nous utilisons des valeurs aléatoires)
            $lobby->start_date = Carbon::now()->addDays(rand(1, 10)); // Date de début du lobby dans les 10 prochains jours
            $lobby->duration = rand(20, 80); // Durée de la partie entre 20 et 80 minutes
            $lobby->save();
        }

        // Créer un lobby privé
        $privateLobby = new Lobby();
        $privateLobby->name = 'Lobby privé'; // Nom du lobby privé
        $privateLobby->max_players = 5; // Nombre maximum de joueurs
        $privateLobby->is_private = true; // Le lobby est privé
        $privateLobby->password = bcrypt('password'); // Mot de passe du lobby privé
        $privateLobby->has_started = false; // Le lobby n'a pas encore démarré
        $privateLobby->has_ended = false; // Le lobby n'est pas encore terminé
        $privateLobby->creation_date = Carbon::now(); // Date de création du lobby privé
        $privateLobby->id_createur = $users->first()->id_user; // Le premier utilisateur est le créateur du lobby privé
        $privateLobby->start_date = Carbon::now()->addDays(1); // Date de début du lobby privé dans 1 jour
        $privateLobby->duration = 2; // Durée du lobby privé de 2 heures
        $privateLobby->save();
    }
}
