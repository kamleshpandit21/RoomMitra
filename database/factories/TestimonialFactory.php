<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
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
            'role' => $this->faker->randomElement(['user', 'room_owner']),
            'message' => $this->faker->paragraph,
            'avatar' => 'https://via.placeholder.com/150?text=' . urlencode($this->faker->firstName),
            'rating' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];

    }
}
