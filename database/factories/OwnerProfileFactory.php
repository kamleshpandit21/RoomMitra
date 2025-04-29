<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OwnerProfile>
 */
class OwnerProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owner = User::where('role', 'room_owner')->inRandomOrder()->first()
            ?? User::factory()->create(['role' => 'room_owner']);

        return [
            'user_id' => $owner->user_id,
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'aadhar' => $this->faker->numerify('####-####-####'),
            'current_address' => $this->faker->address,
            'permanent_address' => $this->faker->address,
            'country' => 'India',
            'locality' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'pincode' => $this->faker->postcode,
            'dob' => $this->faker->date('Y-m-d', '2000-01-01'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'social_links' => [
                'facebook' => 'https://facebook.com/' . $this->faker->userName,
                'linkedin' => 'https://linkedin.com/in/' . $this->faker->userName,
            ],
            'bank_account' => $this->faker->bankAccountNumber,
            'ifsc_code' => strtoupper($this->faker->bothify('####0####')),
        ];
    }
}
