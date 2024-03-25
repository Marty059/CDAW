<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jouer;
use App\Models\Lobby;
use App\Models\User;

class JouerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer trois lobbys existants
        $lobbies = Lobby::limit(10)->get();

        foreach ($lobbies as $lobby) {
            // Récupérer le créateur du lobby
            $lobbyCreator = User::find($lobby->id_createur);

            // S'assurer que le créateur du lobby existe
            if (!$lobbyCreator) {
                continue; // Passer au lobby suivant si le créateur n'est pas trouvé
            }

            // Récupérer le nombre maximum de joueurs pour ce lobby
            $maxPlayers = $lobby->max_players - 1; // Soustraire 1 pour inclure l'utilisateur créateur

            // Récupérer des utilisateurs au hasard pour remplir le lobby, en excluant l'utilisateur créateur
            $randomUsers = User::inRandomOrder()->where('id_user', '!=', $lobbyCreator->id_user)->limit($maxPlayers)->get();

            // Ajouter l'utilisateur créateur du lobby à la liste des joueurs
            $users = $randomUsers->push($lobbyCreator);

            foreach ($users as $user) {
                // Créer une entrée dans la table "Jouer" pour chaque utilisateur de ce lobby
                Jouer::create([
                    'id_lobby' => $lobby->id_lobby,
                    'id_user' => $user->id_user,
                ]);
            }
        }
    }
}
