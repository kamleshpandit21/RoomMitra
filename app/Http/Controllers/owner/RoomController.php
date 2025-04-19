<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomValidation;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use App\Models\RoomAmenity;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $rooms = Room::with('images', 'amenities')->paginate(10);
        return view('owner.my-rooms', compact('rooms'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('owner.create-room');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomValidation $request)
    {
        $room = new Room();
        $room->owner_id = 1;
        $room->room_number = $request->room_number;
        $room->room_title = $request->room_title;
        $room->room_description = $request->room_description ?? null;
        $room->room_price = $request->room_price;
        $room->security_deposit = $request->security_deposit;
        $room->min_stay_months = $request->min_stay_months;
        $room->sharing_prices = json_encode([
            'single' => $request->single_price ?? 0,
            'double' => $request->double_price ?? 0,
            'triple' => $request->triple_price ?? 0
        ]);
        $room->floor = $request->floor ?? null;
        $room->room_capacity = $request->room_capacity;
        $room->total_beds = $request->total_beds;
        $room->ac = $request->has('ac') ? 1 : 0;
        $room->lift = $request->has('lift') ? 1 : 0;
        $room->parking = $request->has('parking') ? 1 : 0;
        $room->kitchen = $request->has('kitchen') ? 1 : 0;
        $room->kitchen_type = $request->kitchen_type;
        $room->bathroom_type = $request->bathroom_type;
        $room->address_line1 = $request->address_line1;
        $room->address_line2 = $request->address_line2;
        $room->city = $request->city;
        $room->state = $request->state;
        // $room->country = $request->country;
        $room->pincode = $request->pincode;
        $room->locality = $request->locality;
        $room->nearby_landmarks = $request->nearby_landmarks;
        $room->entry_time = $request->entry_time;
        $room->exit_time = $request->exit_time;
        $room->restrictions = $request->restrictions;
        $room->is_verified = 0;
        $room->status = 'available';
        $room->save();

        foreach ($request->amenity_name as $index => $name) {
            $room->amenities()->create([
                'amenity_name' => $name,
                'status' => $request->amenity_status[$index],
                'price' => $request->amenity_price[$index] ?? null,
            ]);
        }
        if ($request->hasFile('room_images')) {


            $ownerId = $room->owner_id;
            $roomId = $room->room_id;

            foreach ($request->file('room_images') as $image) {

                // Unique file name generate
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Path banaye
                $destinationPath = public_path("uploads/owners/{$ownerId}/rooms/{$roomId}");

                // Folder agar nahi bana ho to bana do
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Move image to that path
                $image->move($destinationPath, $imageName);

                // Save record in DB
                $room->images()->create([
                    'image_url' => "uploads/owners/{$ownerId}/rooms/{$roomId}/{$imageName}",
                    'image_type' => 'room',
                    'is_featured' => false,
                ]);
            }
        }



        return back()->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $room = Room::findOrFail($id)->with('images', 'amenities')->first();
        $room->sharing_prices = json_decode($room->sharing_prices, true);
        
        return view('owner.view-room', compact('room'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $room = Room::findOrFail($id);
        $room->sharing_prices = json_decode($room->sharing_prices, true);
        return view('owner.room-edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, string $id)
    {

        $room = Room::findOrFail($id);
        $room->update([
            'owner_id' => $room->owner_id,
            'room_number' => $request->room_number,
            'room_title' => $request->room_title,
            'room_description' => $request->room_description ?? null,
            'room_price' => $request->room_price,
            'security_deposit' => $request->security_deposit,
            'min_stay_months' => $request->min_stay_months,
            'sharing_prices' => json_encode([
                'single' => $request->single_price ?? 0,
                'double' => $request->double_price ?? 0,
                'triple' => $request->triple_price ?? 0
            ]),
            'floor' => $request->floor ?? null,
            'room_capacity' => $request->room_capacity,
            'total_beds' => $request->total_beds,
            'ac' => $request->has('ac') ? 1 : 0,
            'lift' => $request->has('lift') ? 1 : 0,
            'parking' => $request->has('parking') ? 1 : 0,
            'kitchen' => $request->has('kitchen') ? 1 : 0,
            'kitchen_type' => $request->kitchen_type,
            'bathroom_type' => $request->bathroom_type,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'locality' => $request->locality,
            'nearby_landmarks' => $request->nearby_landmarks,
            'entry_time' => $request->entry_time,
            'exit_time' => $request->exit_time,
            'restrictions' => $request->restrictions,
        ]);

        $room->save();

        $room->amenities()->delete();
        $existingImages = $room->images;
        foreach ($existingImages as $image) {
            // Delete the file from the server
            $filePath = public_path($image->image_url);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $room->images()->delete();

        foreach ($request->amenity_name as $index => $name) {
            $room->amenities()->create([
                'amenity_name' => $name,
                'status' => $request->amenity_status[$index],
                'price' => $request->amenity_price[$index] ?? null,
            ]);
        }

        if ($request->hasFile('room_images')) {
            $ownerId = $room->owner_id;
            $roomId = $room->room_id;

            foreach ($request->file('room_images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path("uploads/owners/{$ownerId}/rooms/{$roomId}");

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $imageName);

                $room->images()->create([
                    'image_url' => "uploads/owners/{$ownerId}/rooms/{$roomId}/{$imageName}",
                    'image_type' => 'room',
                    'is_featured' => false,
                ]);
            }
        }

        return redirect()->route('owner.rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('owner.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
