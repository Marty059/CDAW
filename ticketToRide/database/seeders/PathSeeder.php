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
            ['city_1' => 'Montreal', 'city_2' => 'Boston','length'=>2, 'colour_1' => 'grey', 'colour_2'=>'grey'],
            ['city_1' => 'Montreal', 'city_2' => 'New York City','length'=>3, 'colour_1' => 'blue', 'colour_2'=>null],
            ['city_1' => 'Montreal', 'city_2' => 'Toronto','length'=>3, 'colour_1' => 'grey', 'colour_2'=>null],
            ['city_1' => 'Montreal', 'city_2' => 'Sault St. Marie','length'=>5, 'colour_1' => 'black', 'colour_2'=>null],
            ['city_1' => 'Toronto', 'city_2' => 'Chicago','length'=>4, 'colour_1' => 'white', 'colour_2'=>null],
            ['city_1' => 'Toronto', 'city_2' => 'Pittsburgh','length'=>2, 'colour_1' => 'grey', 'colour_2'=>null],
            ['city_1' => 'Toronto', 'city_2' => 'Sault St. Marie','length'=>2, 'colour_1' => 'grey', 'colour_2'=>null],
            ['city_1' => 'Pittsburgh', 'city_2' => 'New York City','length'=>2, 'colour_1' => 'white', 'colour_2'=>'green'],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Washington','length'=>2, 'colour_1' => 'grey', 'colour_2'=>null],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Raleigh','length'=>2, 'colour_1' => 'grey', 'colour_2'=>null],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Saint Louis','length'=>5, 'colour_1' => 'green', 'colour_2'=>null],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Nashville','length'=>4, 'colour_1' => 'yellow', 'colour_2'=>null],
            ['city_1' => 'Pittsburgh', 'city_2' => 'Chicago','length'=>3, 'colour_1' => 'orange', 'colour_2'=>'black'],
          
           
        ];
        foreach ($pathCards as $pathCard) {
            Path::create($pathCard);
        }

        
    }
}
