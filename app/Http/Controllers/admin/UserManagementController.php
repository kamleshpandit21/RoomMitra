<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserDeletedMail;
use App\Models\User;
use App\Models\UserDeletionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['profile', 'ownerProfile'])->findOrFail($id);


        $finalProfile = $user->profile ?? $user->ownerProfile;

        return response()->json([
            'user' => $user->only([
                'user_id',
                'full_name',
                'email',
                'phone',
                'role',
                'is_verified',
                'email_verified_at',
                'created_at',
                'provider',
                'profile_completed',
                'is_blocked'
            ]),
            'profile' => $finalProfile
        ]);
    }




    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $reason = $request->input('reason', 'No reason provided');
        $note = $request->input('note');
    
        UserDeletionLog::create([
            'user_id' => $user->user_id,
            'reason' => $reason,
            'note'   => $note,
        ]);

        if ($user->email) {
            Mail::to($user->email)->send(new UserDeletedMail($user, $reason, $note));
        }

        if ($user->profile) {
            $user->profile->delete();
        }

        if ($user->ownerProfile) {
            $user->ownerProfile->delete();
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully and reason logged.']);
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
    public function verify(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = true;
        $user->save();

        return redirect()->back()->with('success', 'User verified successfully.');

    }

}
