<?php

namespace Database\Seeders;

use App\Models\Campground;
use Illuminate\Database\Seeder;

class CampgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i < 101; $i++) {
            Campground::create([
                'section' => 'A',
                'number' => $i,
                'has_fire' => $faker->boolean(),
                'has_table' => $faker->boolean(),
            ]);
        }
    }
}
