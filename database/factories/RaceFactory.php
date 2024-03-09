<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'season_id' => Season::factory(),
            'circuit_id' => \App\Models\Circuit::factory(),
            'round' => $this->faker->numberBetween(1, 23),
            'name' => $this->faker->name,
            'starts_at' => $this->faker->dateTime(),
            'url' => $this->faker->url,
        ];
    }
}
