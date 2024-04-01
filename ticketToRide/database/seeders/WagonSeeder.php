<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wagon;

class WagonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of train cards for each color
        $trainCardsCount = [
            'Black' => 12,
            'Blue' => 12,
            'Green' => 12,
            'Orange' => 12,
            'Pink' => 12,
            'Red' => 12,
            'White' => 12,
            'Yellow' => 12,
            'Null' => 14, // Number of locomotives
        ];

        // Populate the wagon table with train cards
        foreach ($trainCardsCount as $color => $count) {
            if ($color === 'Null') {
                $color = null;
            }

            for ($i = 0; $i < $count; $i++) {
                Wagon::create(['colour' => $color]);
            }
        }
    }
}
