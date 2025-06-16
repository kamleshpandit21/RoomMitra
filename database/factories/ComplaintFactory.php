<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
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
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'user_type' => $this->faker->randomElement(['user', 'room_owner', 'guest']),
            'category' => $this->faker->randomElement(['Noise', 'Cleanliness', 'Water Leakage', 'Other']),
            'subject' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph,

            'attachment' => 'https://via.placeholder.com/150',

            'status' => $this->faker->randomElement(['pending', 'in_progress', 'resolved']),
            'admin_response' => null,
        ];

    }
}
