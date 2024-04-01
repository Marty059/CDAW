<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinationCards = [
            ['city_1' => 'Los Angeles', 'city_2' => 'New York City', 'points' => 21],
            ['city_1' => 'Seattle', 'city_2' => 'New York City', 'points' => 22],
            ['city_1' => 'Duluth', 'city_2' => 'Houston', 'points' => 8],
            ['city_1' => 'San Francisco', 'city_2' => 'Atlanta', 'points' => 17],
            ['city_1' => 'Denver', 'city_2' => 'El Paso', 'points' => 4],
            ['city_1' => 'Chicago', 'city_2' => 'New Orleans', 'points' => 7],
            ['city_1' => 'Calgary', 'city_2' => 'Salt Lake City', 'points' => 7],
            ['city_1' => 'Portland', 'city_2' => 'Phoenix', 'points' => 11],
            ['city_1' => 'Dallas', 'city_2' => 'New York City', 'points' => 11],
            ['city_1' => 'Boston', 'city_2' => 'Miami', 'points' => 12],
            ['city_1' => 'Los Angeles', 'city_2' => 'Miami', 'points' => 20],
            ['city_1' => 'Calgary', 'city_2' => 'Phoenix', 'points' => 13],
            ['city_1' => 'Winnipeg', 'city_2' => 'Little Rock', 'points' => 11],
            ['city_1' => 'Denver', 'city_2' => 'Pittsburgh', 'points' => 11],
            ['city_1' => 'Seattle', 'city_2' => 'Los Angeles', 'points' => 9],
            ['city_1' => 'Chicago', 'city_2' => 'Santa Fe', 'points' => 9],
            ['city_1' => 'Helena', 'city_2' => 'Los Angeles', 'points' => 8],
            ['city_1' => 'Sault Ste. Marie', 'city_2' => 'Nashville', 'points' => 8],
            ['city_1' => 'Vancouver', 'city_2' => 'Santa Fe', 'points' => 13],
            ['city_1' => 'Duluth', 'city_2' => 'El Paso', 'points' => 10],
            ['city_1' => 'Montreal', 'city_2' => 'Atlanta', 'points' => 9],
            ['city_1' => 'Sault Ste. Marie', 'city_2' => 'Oklahoma City', 'points' => 9],
            ['city_1' => 'Portland', 'city_2' => 'Nashville', 'points' => 17],
            ['city_1' => 'New York City', 'city_2' => 'Atlanta', 'points' => 6],
            ['city_1' => 'Dallas', 'city_2' => 'New York City', 'points' => 11],
            ['city_1' => 'Boston', 'city_2' => 'Miami', 'points' => 12],
            ['city_1' => 'Los Angeles', 'city_2' => 'Miami', 'points' => 20],
            ['city_1' => 'Calgary', 'city_2' => 'Phoenix', 'points' => 13],
            ['city_1' => 'Winnipeg', 'city_2' => 'Little Rock', 'points' => 11],
            ['city_1' => 'Denver', 'city_2' => 'Pittsburgh', 'points' => 11],
            ['city_1' => 'Seattle', 'city_2' => 'Los Angeles', 'points' => 9],
            ['city_1' => 'Chicago', 'city_2' => 'Santa Fe', 'points' => 9],
            ['city_1' => 'Vancouver', 'city_2' => 'Montreal', 'points' => 20],
            ['city_1' => 'Portland', 'city_2' => 'Phoenix', 'points' => 11],
            ['city_1' => 'Los Angeles', 'city_2' => 'Chicago', 'points' => 16],
            ['city_1' => 'Winnipeg', 'city_2' => 'Houston', 'points' => 12],
            ['city_1' => 'Sault Ste. Marie', 'city_2' => 'Oklahoma City', 'points' => 9],
            ['city_1' => 'Los Angeles', 'city_2' => 'Miami', 'points' => 20],
            ['city_1' => 'Los Angeles', 'city_2' => 'New York City', 'points' => 21],
            ['city_1' => 'Seattle', 'city_2' => 'New York City', 'points' => 22],
            ['city_1' => 'Duluth', 'city_2' => 'Houston', 'points' => 8],
            ['city_1' => 'San Francisco', 'city_2' => 'Atlanta', 'points' => 17],
            ['city_1' => 'Denver', 'city_2' => 'El Paso', 'points' => 4],
            ['city_1' => 'Chicago', 'city_2' => 'New Orleans', 'points' => 7],
            ['city_1' => 'Calgary', 'city_2' => 'Salt Lake City', 'points' => 7],
            ['city_1' => 'Portland', 'city_2' => 'Phoenix', 'points' => 11],
            ['city_1' => 'Dallas', 'city_2' => 'New York City', 'points' => 11],
            ['city_1' => 'Boston', 'city_2' => 'Miami', 'points' => 12],
        ];

        // Loop through each destination card data and create a new record in the database
        foreach ($destinationCards as $destinationCard) {
            Destination::create($destinationCard);
        }
    }
}
