<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Room;
use App\Models\RoomAmenity;
use App\Models\RoomImage;
use App\Models\Testimonial;
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

        // User::factory()->count(20)->create();


        // $this->call([
        //     AdminSeeder::class,
        //     RoomSeeder::class
        // ]);


        // $this->call(FaqSeeder::class);
        // Complaint::factory()->count(20)->create();
        Testimonial::factory()->count(10)->create();

    }
}
