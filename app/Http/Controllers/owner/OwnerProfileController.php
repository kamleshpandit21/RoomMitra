<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OwnerProfile as Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OwnerProfileController extends Controller
{
    public function index()
    {
        //

        return view('owner.profile');
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProfile()
    {
        $user = Auth::user();
        if ($user->profile === null) {
            // Create default profile if none exists
            $user->profile = new Profile();
            $user->profile->user_id = $user->user_id;
            $user->profile->save();
        }

        return view('owner.edit-profile', compact('user'));
    }


   

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->user_id);
        }
    
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'avatar' => 'nullable|image|max:2048',
            'id_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address' => 'nullable|string|max:500',
            'social_links' => 'nullable|array',
            'social_links.*' => 'nullable|url',
        ]);
    
        // Update User
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->save();
    
        // Update or Create Profile
        $profile = $user->profile ?: new Profile();
        $profile->user_id = $user->user_id;
        $profile->current_address = $request->address ?? 'N/A';
        $profile->permanent_address = $request->permanent_address;
        $profile->locality = $request->locality;
        $profile->country = $request->country;
        $profile->state = $request->state;
        $profile->city = $request->city;
        $profile->pincode = $request->pincode;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->gender = $request->gender;
        $profile->aadhar = $request->aadhar;
        $profile->college_name = $request->college;
        $profile->course = $request->course;
        $profile->study_year = $request->study_year;
        $profile->bio = $request->bio;
    
        // Store social links as JSON
        $profile->social_links = json_encode($request->social_links ?? []);
    
        // Avatar upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $fileName = 'profile_' . md5($user->email) . '.' . $avatar->getClientOriginalExtension();
            $filePath = 'profile_images/' . $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($avatar));
            $profile->avatar = 'storage/' . $filePath;
        }
    
        // ID card upload
        if ($request->hasFile('id_card')) {
            $idCard = $request->file('id_card');
            $fileName = 'idcard_' . md5($user->email) . '.' . $idCard->getClientOriginalExtension();
            $filePath = 'id_cards/' . $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($idCard));
            $profile->id_card_url = 'storage/' . $filePath;
        }
    
        $profile->save();
    
        return redirect()->route('owner.profile.index')->with('success', 'Profile updated successfully.');
    }
    


    public function updatePassword(Request $request)
    {


        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            
        ]); 
        

        $userId = Auth::user()->user_id;
        $user = User::find($userId);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('owner.profile.index')->with('success', 'Password updated successfully.');
        } else {
            return back()->withErrors(['error' => 'The current password is incorrect.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
