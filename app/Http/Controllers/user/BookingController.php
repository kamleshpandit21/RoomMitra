<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('user.invoice');

    }
    public function checkout(Room $room)
    {
        return view('user.checkout', compact('room'));
    }

    public function pay(Request $request, Room $room)
    {
        // Fake logic: random success/failure
        $isSuccess = rand(0, 1);
        $paymentSuccess = true;

        // Optionally create a Booking record
        Booking::create([
            'user_id' => 1,
            'owner_id' => $room->owner->user_id, // Assuming Room has user_id (owner)
            'room_id' => $room->room_id,
            'check_in_date' => now()->toDateString(),
            'check_out_date' => now()->addMonth()->toDateString(), // dummy
            'total_amount' => $room->room_price + $room->security_deposit,
            'status' => $paymentSuccess ? 'confirmed' : 'pending',
            'payment_status' => $paymentSuccess ? 'paid' : 'failed',
            'payment_method' => $request->input('payment_method') ?? 'dummy',
            'transaction_id' => 'TXN' . rand(100000, 999999),
        ]);
        return $paymentSuccess
        ? redirect()->route('user.booking.success')
        : redirect()->route('user.booking.fail');   }

    public function success()
    {
        return view('user.status', ['status' => 'success']);
    }

    public function fail()
    {
        return view('user.status', ['status' => 'fail']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $room = Room::where('room_id', $id)->with('images', 'amenities', 'owner')->firstOrFail();
        $room->sharing_prices = json_decode($room->sharing_prices, true);

        return view('user.invoice', compact('room'));
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
