<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class CommonRoomController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Room::query()
            ->where('is_verified', true)
            ->where('status', 'available')
            ->with(['images', 'amenities', 'owner']);
    
        // Apply filters
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
    
        if ($request->filled('min_price')) {
            $query->where('room_price', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $query->where('room_price', '<=', $request->max_price);
        }
    
        if ($request->filled('capacity')) {
            $query->where('room_capacity', $request->capacity);
        }
    
        $rooms = $query->orderBy('created_at', 'desc')->paginate(6);
    
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
