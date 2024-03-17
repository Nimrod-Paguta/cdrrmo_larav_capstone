<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\register>
 */
class RegisterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'middlename' => $this->faker->optional()->lastName,
            'lastname' => $this->faker->lastName,
            'barangay' => $this->faker->streetName,
            'municipality' => $this->faker->city,
            'province' => $this->faker->state,
            'contactnumber' => $this->faker->numerify('##########'),
            'emergencynumber' => $this->faker->numerify('##########'),
            'medicalcondition' => $this->faker->optional()->sentence,
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'vehiclelicense' => $this->faker->bothify('???###'),
            'color' => $this->faker->colorName,
            'type' => $this->faker->randomElement(['Private', 'Public']),
        ];
    }
}
