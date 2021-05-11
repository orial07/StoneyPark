<?php

namespace Database\Factories;

use App\Models\Campground;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date_in = $this->faker->dateTimeBetween('now', '+1 month');
        $date_out = $this->faker->dateTimeBetween('+1 month', '+2 months');
        $cg = Campground::inRandomOrder()->first();
        $campsite = $cg->section . '-' . $cg->number;

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'age' => 18,
            'camping_type' => $this->faker->numberBetween(0, 1),
            'date_in' => $date_in,
            'date_out' => $date_out,
            'campground_id' => $campsite,
            'status' => 'paid',
        ];
    }
}
