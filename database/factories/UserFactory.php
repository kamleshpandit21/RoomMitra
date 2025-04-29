<?php

namespace Database\Factories;

use App\Models\OwnerProfile;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
                'full_name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // Default password
                'phone' => $this->faker->unique()->numerify('98########'),
                'role' => $this->faker->randomElement(['user', 'room_owner']),
                'is_verified' => $this->faker->boolean(80),
                'is_blocked' => false,
                'provider' => null,
                'provider_id' => null,
                'remember_token' => Str::random(10),
                'profile_completed' => $this->faker->boolean(90),
            ];  
    }

    public function configure()
{
    return $this->afterCreating(function ($user) {
        if ($user->role === 'room_owner') {
            OwnerProfile::factory()->create([
                'user_id' => $user->user_id,
                // Add other default values if needed
            ]);
        } else {
            Profile::factory()->create([
                'user_id' => $user->user_id,
                // Add other default values if needed
            ]);
        }
    });
}
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
