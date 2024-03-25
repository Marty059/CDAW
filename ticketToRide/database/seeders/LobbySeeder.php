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
            $lobby->max_players = rand(2, 5); // Générer un nombre aléatoire entre 2 et 5 pour max_players
            $lobby->is_private = false; // Par défaut, le lobby n'est pas privé
            $lobby->has_started = false; // Par défaut, le lobby n'a pas encore démarré
            $lobby->has_ended = true; // Par défaut, le lobby n'est pas encore terminé
            $lobby->creation_date = Carbon::now(); // Date de création du lobby
            $lobby->id_createur = $user->id_user; // L'utilisateur actuel est le créateur du lobby

            // Génération de la date de début et de la durée du lobby (pour l'exemple, nous utilisons des valeurs aléatoires)
            $lobby->start_date = Carbon::now()->addDays(rand(1, 10)); // Date de début du lobby dans les 10 prochains jours
            $lobby->duration = rand(1, 24); // Durée du lobby entre 1 et 24 heures

            $lobby->save();
        }
    }
}
