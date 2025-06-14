<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('room')->get();
        return view('user.wishlist', compact('wishlists'));
    }

    public function toggle($roomId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $userId = Auth::id();

            // Check if wishlist entry already exists
            $wishlist = Wishlist::where('user_id', $userId)
                ->where('room_id', $roomId)
                ->first();

            if ($wishlist) {
                $wishlist->delete();

                return response()->json([
                    'success' => true,
                    'status' => 'removed',
                    'message' => 'Removed from wishlist'
                ]);
            } else {
                Wishlist::create([
                    'user_id' => $userId,
                    'room_id' => $roomId,
                ]);

                return response()->json([
                    'success' => true,
                    'status' => 'added',
                    'message' => 'Added to wishlist'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
