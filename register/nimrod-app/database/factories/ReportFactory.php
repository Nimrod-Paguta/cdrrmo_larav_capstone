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
            'barangay'  => $this->faker->randomElement(['Barangay 1', 'Barangay 2', 'Baranagay 3', 'Barangay 4', 'Barangay 5', 'Barangay 6', 'Barangay 7', 'Barangay 8',
             'Barangay 9', 'Barangay 10', 'Barangay 11', 'Aglayan', 'Apo Macote', 'Bangcud', 'Busdi', 'Cabangahan', 'Caburacanan', 'Can-ayan', 'Capitan Angel', 
            'Casisang', 'Dalwangan', 'Imbayao', 'Indalasa', 'Kalasungay', 'Kibalabag', 'Kulaman', 'Laguitas', 'Linabo', 'Magsaysay', 'Maligaya', 'Managok', 
            'Manalog', 'Mapayag', 'Mapulo', 'Miglamin', 'Patpat', 'Saint Peter', 'San Jose', 'San Martin', 'Santo Niño', 'Silae', 'Simaya', 'Sinanglanan', 
            'Sumpong', 'Violeta', 'Zamboanguita']),
            'city' => 'Malaybalay City',
            'address' => $this->faker->address()
        ];
    }
}

