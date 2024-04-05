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
        $users = User::all();

        for ($i = 1; $i <= 3; $i++) {
            $lobby = new Lobby();
            $lobby->name = 'Lobby ' . $i; 
            $lobby->max_players = 5; 
            $lobby->is_private = false; 
            $lobby->password = bcrypt(''); 
            $lobby->has_started = false; 
            $lobby->has_ended = false; 
            $lobby->creation_date = Carbon::now(); 
            $lobby->id_createur = $users->random()->id_user; 
            $lobby->save();
        }

        foreach ($users as $user) {
            $lobby = new Lobby();
            $lobby->name = 'Lobby de ' . $user->username; 
            $lobby->max_players = rand(2, 5); 
            $lobby->is_private = false; 
            $lobby->password = bcrypt(''); 
            $lobby->has_started = false; 
            $lobby->has_ended = false; 
            $lobby->creation_date = Carbon::now(); 
            $lobby->id_createur = $user->id_user; 
            $lobby->save();
        }

        $privateLobby = new Lobby();
        $privateLobby->name = 'Lobby privé'; 
        $privateLobby->max_players = 5; 
        $privateLobby->is_private = true; 
        $privateLobby->password = bcrypt('password'); 
        $privateLobby->has_started = false;
        $privateLobby->has_ended = false; 
        $privateLobby->creation_date = Carbon::now(); 
        $privateLobby->id_createur = $users->first()->id_user; 
        $privateLobby->start_date = Carbon::now()->addDays(1); 
        $privateLobby->duration = 2; 
        $privateLobby->save();
    

        for ($i = 1; $i <= 20; $i++) {
            $lobby = new Lobby();
            $lobby->name = 'Lobby ' . $i; 
            $lobby->max_players = 5; 
            $lobby->is_private = false; 
            $lobby->password = bcrypt(''); 
            $lobby->has_started = true; 
            $lobby->has_ended = true; 
            $lobby->creation_date = Carbon::now(); 
            $lobby->id_createur = $users->random()->id_user; 
            $lobby->start_date = Carbon::now()->addDays(rand(1, 10))->addHours(rand(1,3))->addMinutes(rand(10,35)); 
            $lobby->duration = rand(20, 80); 
            $lobby->save();
        }

    }
}
