<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\OwnerProfile;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    //
    public function redirectToProvider($provider)
    {
        $role = request()->query('role');
        Session::put('social_login_role', $role);
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {

        try {
            $socialUser = Socialite::driver($provider)->user();
            $role = Session::pull('social_login_role');
            if (!$socialUser->getEmail()) {
                return redirect()->route('login.form')->with('error', 'Email not provided by provider.');
            }
            // Step 1: Check if user exists
            $user = User::firstOrCreate(
                ['email' => $socialUser->email],
                [
                    'full_name' => $socialUser->name,
                    'provider' => $provider,
                    'provider_id' => $socialUser->id,
                    'password' => bcrypt(uniqid()),
                    'is_verified' => true,
                    'email_verified_at' => now(),
                    'role' => $role,
                ]
            );

            // Step 2: Download and save image if available
            $profileImagePath = null;
            if ($socialUser->avatar) {
                $profileImagePath = $this->downloadAndSaveImage($socialUser->avatar, $socialUser->email);
            }

            $this->createOrUpdateProfile($user, $profileImagePath);

            Auth::login($user);
            if ($user->role === 'room_owner') {
                $user->load('ownerProfile');
            } else {
                $user->load('profile');
            }

           return redirect()->route($user->role === 'room_owner' ? 'owner.dashboard' : 'user.dashboard');



        } catch (\Exception $e) {
            return redirect()->route('login.form')->with('error', 'Error: ' . $e->getMessage());
        }
    }


    private function downloadAndSaveImage($imageUrl, $email)
    {
        try {
            $imageContents = file_get_contents($imageUrl);

            // Safe and unique file name
            $fileName = 'profile_' . md5($email) . '.png';

            // Yeh path hoga: storage/app/public/profile_images/filename.png
            $filePath = 'profile_images/' . $fileName;

            // Laravel storage disk me save karna (public disk use karo)
            Storage::disk('public')->put($filePath, $imageContents);

            // Yeh path browser ke liye accessible hoga: public/storage/profile_images/filename.png
            return 'storage/' . $filePath;
        } catch (\Exception $e) {
            return null;
        }
    }


    private function createOrUpdateProfile($user, $avatarPath)
    {
        if ($user->role === 'room_owner') {
            $profile = OwnerProfile::firstOrNew(['user_id' => $user->user_id]);
        } else {
            $profile = Profile::firstOrNew(['user_id' => $user->user_id]);
        }

        // Delete old image if exists
        if ($profile->avatar) {
            Storage::delete($profile->avatar);
        }

        $profile->avatar = $avatarPath;
        $profile->save();
    }

}
