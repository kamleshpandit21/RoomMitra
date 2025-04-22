<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Room;
use App\Models\RoomAmenity;
use App\Models\RoomImage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->count(10)->create();

        // Create rooms for some users
        Room::factory()->count(20)->create();

        // Attach images and amenities for the created rooms
        RoomImage::factory()->count(50)->create();
        RoomAmenity::factory()->count(50)->create();
        Complaint::factory()->count(10)->create();

        $this->call([
            AdminSeeder::class,
        ]);
    }
}
