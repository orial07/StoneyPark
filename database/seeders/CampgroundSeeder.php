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
        Campground::truncate();
        for ($i = 1; $i <= 63; $i++) {
            Campground::create([
                'section' => 'A',
                'number' => $i,
            ]);
        }
        for ($i = 1; $i <= 37; $i++) {
            Campground::create([
                'section' => 'B',
                'number' => $i,
            ]);
        }
    }
}
