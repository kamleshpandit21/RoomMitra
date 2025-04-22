<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rooms = Room::with('images', 'amenities', 'owner')->paginate(10);
        return view('admin.rooms', compact('rooms'));
    }

    public function approve(Room $room,$id)
    {
        $room = Room::findOrFail($id);

        $room->is_verified = true;
        $room->save();


        return redirect()->route('admin.rooms.index')->with('success', 'Room approved successfully.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    
        $room = Room::where('room_id', $id)->with('images', 'amenities', 'owner')->first();
        $room->sharing_prices = json_decode($room->sharing_prices, true);
        return view('admin.room-details', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
