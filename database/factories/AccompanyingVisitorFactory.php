<?php

namespace Database\Factories;

use App\Models\AccompanyingVisitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AccompanyingVisitor>
 */
class AccompanyingVisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => \App\Models\Booking::factory(),
            'full_name' => fake()->name(),
            'age' => fake()->numberBetween(18, 70),
            'sex' => fake()->randomElement(['Male', 'Female']),
            'id_type' => fake()->randomElement(['PhilSys National ID', "Driver's License", 'Passport', 'UMID']),
            'id_number' => fake()->bothify('ID-#####-???'),
            'relationship_to_pdl' => fake()->randomElement(['Spouse', 'Child', 'Sibling', 'Parent', 'Relative']),
        ];
    }
}
