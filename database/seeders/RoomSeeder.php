<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomAmenity;
use App\Models\RoomImage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {$owners = User::factory()->count(10)->create(['role' => 'room_owner', 'is_verified' => true]);

        // Create 20 rooms
        $rooms = Room::factory()->count(20)->create([
            'owner_id' => function () use ($owners) {
                return $owners->random()->user_id;
            },
        ]);

        $amenities = ['WiFi', 'Laundry', 'RO Water', 'Fridge', 'TV', 'Microwave'];

        foreach ($rooms as $room) {
            // Attach 3–5 room images
            RoomImage::factory()->count(rand(3, 5))->create([
                'room_id' => $room->room_id,
            ]);

            // Attach all amenities uniquely
            foreach ($amenities as $amenity) {
                RoomAmenity::create([
                    'room_id' => $room->room_id,
                    'amenity_name' => $amenity,
                    'status' => $status = fake()->randomElement(['free', 'paid']),
                    'price' => $status === 'paid' ? fake()->numberBetween(50, 300) : null,
                ]);
            }
        }
    }
}
