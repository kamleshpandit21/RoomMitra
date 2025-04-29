<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        // Ensure this profile belongs to a user with role = 'user'
        $user = User::where('role', 'user')->inRandomOrder()->first()
                 ?? User::factory()->create(['role' => 'user']);

        return [
            'user_id' => $user->user_id,
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'current_address' => $this->faker->address,
            'permanent_address' => $this->faker->address,
            'country' => 'India',
            'locality' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'pincode' => $this->faker->postcode,
            'date_of_birth' => $this->faker->date('Y-m-d', '2005-01-01'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'aadhar' => $this->faker->numerify('####-####-####'),
            'college_name' => $this->faker->company . ' University',
            'course' => $this->faker->randomElement(['B.Tech', 'B.Sc', 'BA', 'MBA', 'M.Tech']),
            'study_year' => $this->faker->numberBetween(1, 4),
            'id_card_url' => $this->faker->imageUrl(300, 200, 'idcard'),
            'bio' => $this->faker->sentence(10),
            'social_links' => [
                'instagram' => 'https://instagram.com/' . $this->faker->userName,
                'linkedin' => 'https://linkedin.com/in/' . $this->faker->userName,
            ],
        ];
    }
}
