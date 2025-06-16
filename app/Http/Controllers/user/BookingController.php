<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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
        $room->sharing_prices = json_decode($room->sharing_prices, true);
        return view('user.checkout', compact('room'));
    }

    public function pay(Request $request, $room)
    {
        $Room = Room::where('room_id', $room)->with('images', 'amenities', 'owner')->firstOrFail();
        // Fake logic: random success/failure
        $isSuccess = rand(0, 1);
        $paymentSuccess = true;

        $checkin = \Carbon\Carbon::createFromFormat('d-m-Y', $request->checkin_date)->format('Y-m-d');
        $checkout = \Carbon\Carbon::createFromFormat('d-m-Y', $request->checkout_date)->format('Y-m-d');

        Booking::create([
            'user_id' => FacadesAuth::user()->user_id,
            'owner_id' => $Room->owner_id,
            'room_id' => $Room->room_id,
            'check_in_date' => $checkin,
            'check_out_date' => $checkout,
            'total_amount' => $request->total,
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'payment_method' => 'dummy',
            'transaction_id' => 'TXN' . rand(100000, 999999),
        ]);

        return $paymentSuccess
            ? redirect()->route('user.booking.success')
            : redirect()->route('user.booking.fail');
    }

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
