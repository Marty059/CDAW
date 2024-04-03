<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Path;

class PathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathCards = [
            ['city_1' => 'Montreal', 'city_2' => 'Boston','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Montreal', 'city_2' => 'Boston','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Montreal', 'city_2' => 'New York City','length'=>3, 'colour' => 'blue'],
            ['city_1' => 'Montreal', 'city_2' => 'Toronto','length'=>3, 'colour' => 'grey'],
            ['city_1' => 'Montreal', 'city_2' => 'Sault St. Marie','length'=>5, 'colour' => 'black'],
            ['city_1' => 'Toronto', 'city_2' => 'Chicago','length'=>4, 'colour' => 'white'],
            ['city_1' => 'Toronto', 'city_2' => 'Pittsburgh','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Toronto', 'city_2' => 'Sault St. Marie','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Toronto', 'city_2' => 'Duluth','length'=>6, 'colour' => 'pink'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'New York City','length'=>2, 'colour' => 'white'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'New York City','length'=>2, 'colour' => 'green'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Washington','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Raleigh','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Saint Louis','length'=>5, 'colour' => 'green'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Nashville','length'=>4, 'colour' => 'yellow'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Chicago','length'=>3, 'colour' => 'orange'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Chicago','length'=>3, 'colour' => 'black'], 
            ['city_1' => 'New York City', 'city_2' => 'Boston','length'=>2, 'colour' => 'yellow'],   
            ['city_1' => 'New York City', 'city_2' => 'Boston','length'=>2, 'colour' => 'red'],    
            ['city_1' => 'New York City', 'city_2' => 'Washington','length'=>2, 'colour' => 'orange'],
            ['city_1' => 'New York City', 'city_2' => 'Wahsington','length'=>2, 'colour' => 'black'], 
            ['city_1' => 'Raleigh', 'city_2' => 'Washington','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Raleigh', 'city_2' => 'Washington','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Raleigh', 'city_2' => 'Atlanta','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Raleigh', 'city_2' => 'Atlanta','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Raleigh', 'city_2' => 'Nashville','length'=>3, 'colour' => 'black'],
            ['city_1' => 'Raleigh', 'city_2' => 'Charleston','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Atlanta', 'city_2' => 'Charleston','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Atlanta', 'city_2' => 'Miami','length'=>5, 'colour' => 'blue'],
            ['city_1' => 'Atlanta', 'city_2' => 'New Orleans','length'=>4, 'colour' => 'orange'],
            ['city_1' => 'Atlanta', 'city_2' => 'New Orleans','length'=>4, 'colour' => 'yellow'],
            ['city_1' => 'Atlanta', 'city_2' => 'Nashville','length'=>1, 'colour' => 'grey'],
            ['city_1' => 'Miami', 'city_2' => 'Charleston','length'=>4, 'colour' => 'pink'],
            ['city_1' => 'Miami', 'city_2' => 'New Orleans','length'=>6, 'colour' => 'red'],
            ['city_1' => 'Chicago', 'city_2' => 'Saint Louis','length'=>2, 'colour' => 'green'],
            ['city_1' => 'Chicago', 'city_2' => 'Saint Louis','length'=>2, 'colour' => 'white'],
            ['city_1' => 'Chicago', 'city_2' => 'Omaha','length'=>4, 'colour' => 'blue'],
            ['city_1' => 'Chicago', 'city_2' => 'Duluth','length'=>3, 'colour' => 'red'],
            ['city_1' => 'Saint Louis', 'city_2' => 'Kansas City','length'=>2, 'colour' => 'blue'],
            ['city_1' => 'Saint Louis', 'city_2' => 'Kansas City','length'=>2, 'colour' => 'pink'],
            ['city_1' => 'Saint Louis', 'city_2' => 'Little Rock','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Saint Louis', 'city_2' => 'Nashville','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Little Rock', 'city_2' => 'Oklahoma City','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Little Rock', 'city_2' => 'Dallas','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Little Rock', 'city_2' => 'Nashville','length'=>3, 'colour' => 'white'],
            ['city_1' => 'Little Rock', 'city_2' => 'New Orleans','length'=>3, 'colour' => 'green'],
            ['city_1' => 'Houston', 'city_2' => 'Dallas','length'=>1, 'colour' => 'grey'],
            ['city_1' => 'Houston', 'city_2' => 'Dallas','length'=>1, 'colour' => 'grey'],
            ['city_1' => 'Houston', 'city_2' => 'New Orleans','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Houston', 'city_2' => 'El Paso','length'=>6, 'colour' => 'green'],
            ['city_1' => 'Sault St. Marie', 'city_2' => 'Duluth','length'=>3, 'colour' => 'grey'],
            ['city_1' => 'Sault St. Marie', 'city_2' => 'Winnipeg','length'=>6, 'colour' => 'grey'],
            ['city_1' => 'Duluth', 'city_2' => 'Omaha','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Duluth', 'city_2' => 'Omaha','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Duluth', 'city_2' => 'Helena','length'=>6, 'colour' => 'orange'],
            ['city_1' => 'Duluth', 'city_2' => 'Winnipeg','length'=>4, 'colour' => 'black'],
            ['city_1' => 'Helena', 'city_2' => 'Winnipeg','length'=>4, 'colour' => 'blue'],
            ['city_1' => 'Helena', 'city_2' => 'Omaha','length'=>5, 'colour' => 'red'],
            ['city_1' => 'Helena', 'city_2' => 'Denver','length'=>4, 'colour' => 'green'],
            ['city_1' => 'Helena', 'city_2' => 'Salt Lake City','length'=>3, 'colour' => 'pink'],
            ['city_1' => 'Helena', 'city_2' => 'Seattle','length'=>6, 'colour' => 'yellow'],
            ['city_1' => 'Helena', 'city_2' => 'Calgary','length'=>4, 'colour' => 'grey'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'Kansas City','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'Kansas City','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'Dallas','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'Dallas','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'El Paso','length'=>5, 'colour' => 'yellow'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'Santa Fe','length'=>3, 'colour' => 'blue'],
            ['city_1' => 'Oklahoma City', 'city_2' => 'Denver','length'=>4, 'colour' => 'red'],
            ['city_1' => 'Kansas City', 'city_2' => 'Omaha','length'=>1, 'colour' => 'grey'],
            ['city_1' => 'Kansas City', 'city_2' => 'Omaha','length'=>1, 'colour' => 'grey'],
            ['city_1' => 'Denver', 'city_2' => 'Omaha','length'=>4, 'colour' => 'pink'],
            ['city_1' => 'Denver', 'city_2' => 'Kansas City','length'=>4, 'colour' => 'black'],
            ['city_1' => 'Denver', 'city_2' => 'Kansas City','length'=>4, 'colour' => 'orange'],
            ['city_1' => 'Denver', 'city_2' => 'Santa Fe','length'=>2, 'colour' => 'grey'],
            ['city_1' => 'Denver', 'city_2' => 'Phoenix','length'=>5, 'colour' => 'white'],
            ['city_1' => 'Denver', 'city_2' => 'Salt Lake City','length'=>3, 'colour' => 'red'],
            ['city_1' => 'Denver', 'city_2' => 'Salt Lake City','length'=>4, 'colour' => 'yellow'],
            
           



           
        ];
        foreach ($pathCards as $pathCard) {
            Path::create($pathCard);
        }

        
    }
}
