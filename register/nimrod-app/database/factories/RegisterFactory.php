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
             'barangay'  => $this->faker->randomElement(['Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5', 'Barangay 6', 'Barangay 7', 'Barangay 8',
             'Barangay 9', 'Barangay 10', 'Barangay 11', 'Aglayan', 'Apo Macote', 'Bangcud', 'Busdi', 'Cabangahan', 'Caburacanan', 'Can-ayan', 'Capitan Angel', 
            'Casisang', 'Dalwangan', 'Imbayao', 'Indalasa', 'Kalasungay', 'Kibalabag', 'Kulaman', 'Laguitas', 'Linabo', 'Magsaysay', 'Maligaya', 'Managok', 
            'Manalog', 'Mapayag', 'Mapulo', 'Miglamin', 'Patpat', 'Saint Peter', 'San Jose', 'San Martin', 'Santo Niño', 'Silae', 'Simaya', 'Sinanglanan', 
            'Sumpong', 'Violeta', 'Zamboanguita']),
            'municipality' => $this->faker->city,
            'province' => $this->faker->state,
            'contactnumber' => $this->faker->numerify('##########'),
            'emergencynumber' => $this->faker->numerify('##########'),
            'medicalcondition' => $this->faker->optional()->sentence,
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'vehiclelicense' => strtoupper($this->faker->bothify('???###')),
            'color' => $this->faker->colorName,
            'type' => $this->faker->randomElement(['Private', 'Public']),
            'created_at' => $this->faker->dateTimeBetween('2023-12-01', '2024-04-08')->format('Y-m-d H:i:s'),
        ];
    }
}
