<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('profile', 'ownerProfile')->paginate(10);
        return view('admin.users', compact('users'));
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
        $user = User::with('profile', 'ownerProfile')->find($id);
        return response()->json($user);
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
        $user = User::findOrFail($id);
    
        // Optional: Also delete related profile or ownerProfile
        if ($user->profile) {
            $user->profile->delete();
        }
    
        if ($user->ownerProfile) {
            $user->ownerProfile->delete();
        }
    
        $user->delete();
    
        return response()->json(['message' => 'User deleted successfully.']);
    }
    

    public function block(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true;
        $user->save();

        return response()->json([
            'message' => $user->is_blocked ? 'User blocked successfully.' : 'User unblocked successfully.',
            'is_blocked' => $user->is_blocked
        ]);
    }

    public function unblock(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = false;
        $user->save();

        return response()->json([
            'message' => $user->is_blocked ? 'User blocked successfully.' : 'User unblocked successfully.',
            'is_blocked' => $user->is_blocked
        ]);
    }
}
