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
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'username' => 'user' . $i,
                'password' => bcrypt('password'),
                'email' => 'user' . $i . '@example.com',
                'country' => 'Country ' . $i,
                'is_admin' => ($i == 1 || $i == 2) ? true : false,
                'is_banned' => ($i == 3 || $i == 4) ? true : false,
                'remember_token' => '',
            ]);
        }
    }
}
