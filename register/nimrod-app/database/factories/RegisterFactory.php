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
            'name' => $this->faker->name,
            'middlename' => $this->faker->lastName,
            'lastname' => $this->faker->lastName,
            'barangay' => $this->faker->word,
            'municipality' => $this->faker->word,
            'province' => $this->faker->word,
            'contactnumber' => $this->faker->phoneNumber,
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'vehiclelicense' => $this->faker->word,
            'placard' => $this->faker->word,
            'color' => $this->faker->colorName,
            'date' => $this->faker->date,
        ];
    }
}
