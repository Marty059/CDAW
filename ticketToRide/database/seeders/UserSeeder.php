<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création de 10 utilisateurs fictifs
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'username' => 'user' . $i,
                'password' => Hash::make('password'),('password'), // Vous pouvez utiliser Hash::make pour hasher les mots de passe
                'email' => 'user' . $i . '@example.com',
                'country' => 'Country ' . $i,
                'is_admin' => false, // Par défaut, les utilisateurs ne sont pas des administrateurs
                'is_banned' => false, // Par défaut, les utilisateurs ne sont pas bannis
            ]);
        }
        //\App\Models\User::factory(10)->create();
    }
}
