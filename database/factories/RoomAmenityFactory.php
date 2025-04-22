<?php
namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomAmenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomAmenity>
 */
class RoomAmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Predefined amenities
        $amenities = ['WiFi', 'Laundry', 'RO Water', 'Fridge', 'TV', 'Microwave'];

        // Get a random room
        $room = Room::inRandomOrder()->first();

        // Get already existing amenities for this room to avoid duplicates
        $existingAmenities = RoomAmenity::where('room_id', $room->room_id)
                                        ->pluck('amenity_name')
                                        ->toArray();

        // Filter out amenities that are already assigned to this room
        $availableAmenities = array_diff($amenities, $existingAmenities);

        // If no amenities are available to assign, return an empty array
        if (empty($availableAmenities)) {
            return [];
        }

        // Randomly pick one amenity from the remaining available amenities
        $selectedAmenity = $this->faker->randomElement($availableAmenities);
        
        // Check if this combination already exists in the database to prevent duplication
        if (RoomAmenity::where('room_id', $room->room_id)->where('amenity_name', $selectedAmenity)->exists()) {
            // If the combination already exists, return an empty array to skip insertion
            return [];
        }

        // Assign a random status (free, paid, or not_available)
        $status = $this->faker->randomElement(['free', 'paid']);
        
        // Create the amenity for the room
        return [
            'room_id' => $room->room_id,
            'amenity_name' => $selectedAmenity,
            'status' => $status,
            'price' => $status === 'paid' ? $this->faker->numberBetween(50, 300) : null, // Only set price for 'paid' status
        ];
    }
}
