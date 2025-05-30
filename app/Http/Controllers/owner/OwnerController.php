<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    //
    public function index(){
        $rooms = Room::where('owner_id', Auth::user()->user_id)->get();
        return view('owner.dashboard', compact('rooms'));
    }
}
