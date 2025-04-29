<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class CommonRoomController extends Controller
{
    //
    public function index()
    {

        $rooms = Room::where('is_verified', true)
            ->where('status', 'available')
            ->with('images', 'amenities', 'owner')
            ->orderBy('created_at', 'desc')
            ->paginate(6);


        return view('common.room-list', compact('rooms'));
    }
    public function show(string $id)
    {
        $room = Room::where('room_id', $id)
            ->with(['images', 'amenities', 'owner'])
            ->whereHas('owner')
            ->firstOrFail();
        $room->sharing_prices = json_decode($room->sharing_prices, true);
        return view('user.room-details', compact('room'));
    }
}
