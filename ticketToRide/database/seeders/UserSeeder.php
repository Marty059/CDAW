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
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'username' => 'user' . $i,
                'password' => bcrypt('password'),
                'email' => 'user' . $i . '@example.com',
                'country' => 'Country ' . $i,
                'is_admin' => false, 
                'is_banned' => false, 
                'remember_token' => '',
            ]);
        }
    }
}
