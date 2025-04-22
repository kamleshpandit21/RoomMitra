<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      

        return [
            'owner_id' => User::inRandomOrder()->first()->user_id ?? User::factory(),
            'room_number' => strtoupper($this->faker->bothify('A###')),
            'room_title' => $this->faker->sentence(4),
            'room_description' => $this->faker->paragraph(2),
            'room_price' => $this->faker->numberBetween(3000, 10000),
            'security_deposit' => $this->faker->numberBetween(1000, 5000),
            'min_stay_months' => $this->faker->numberBetween(1, 6),
            'sharing_prices' => json_encode([
                'single' => $this->faker->numberBetween(6000, 9000),
                'double' => $this->faker->numberBetween(4000, 6000)
            ]),
            'room_capacity' => $this->faker->numberBetween(1, 4),
            'total_beds' => $this->faker->numberBetween(1, 4),
            'floor' => $this->faker->randomElement(['1st', '2nd', 'Ground', '3rd']),
            'ac' => $this->faker->boolean(),
            'lift' => $this->faker->boolean(),
            'parking' => $this->faker->boolean(),
            'bathroom_type' => $this->faker->randomElement(['attached', 'shared']),
            'kitchen' => $this->faker->boolean(),
            'kitchen_type' => $this->faker->randomElement(['personal', 'shared']),
            'address_line1' => $this->faker->streetAddress(),
            'address_line2' => $this->faker->optional()->secondaryAddress(),
            'locality' => $this->faker->word(),
            'city' => 'Lucknow',
            'state' => 'Uttar Pradesh',
            'pincode' => $this->faker->postcode(),
            'nearby_landmarks' => $this->faker->optional()->sentence(),
            'latitude' => $this->faker->latitude(28.4, 28.7),
            'longitude' => $this->faker->longitude(77.0, 77.5),
            'entry_time' => now()->setTime(6, 0),
            'exit_time' => now()->setTime(22, 0),
            'check_in' => true,
            'check_out' => true,
            'check_in_time' => now()->setTime(12, 0),
            'check_out_time' => now()->setTime(10, 0),
            'restrictions' => 'No smoking. No pets.',
            'is_verified' => $this->faker->boolean(),
            'status' => 'available',
        ];
    }
}
