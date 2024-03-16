<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registereduserid' => $this->faker->uuid,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'time' => $this->faker->time(),
            'gforce' => $this->faker->randomFloat(2, 0, 10),
            'status' => $this->faker->randomElement(['completed', 'unread', 'ongoing']),
            'month' => $this->faker->monthName(),
        ];
    }
}

