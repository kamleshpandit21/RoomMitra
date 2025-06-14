<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\OwnerProfile;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * ================================
     * Show the application login form.
     *=================================
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return redirect()->route($user->role === 'room_owner' ? 'owner.dashboard' : 'user.dashboard');
        }

        return view('auth.login');
    }

    /**
     * ================================
     * Show the application Register form.
     *=================================
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return redirect()->route($user->role === 'room_owner' ? 'owner.dashboard' : 'user.dashboard');
        }

        return view('auth.register');
    }

    /**
     * ===============================================
     * Register a new user.
     * ===============================================
     */

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:2|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|confirmed',
            'role' => 'required|in:user,room_owner',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        $this->createDefaultProfile($user);


        Auth::login($user);

        return redirect()->route($user->role === 'room_owner' ? 'owner.dashboard' : 'user.dashboard')->with('success', 'Registration successful. You are now logged in.');

    }


    /**
     * ===============================================
     * Login user.
     * ===============================================
     */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->is_blocked) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been blocked.']);
            }

            if ($user->role === 'room_owner') {

                return redirect()->route('owner.dashboard');
            }


            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }



    /**
     * ===============================================
     * Logout user.
     * ===============================================
     */
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function createDefaultProfile(User $user)
    {
        $avatar = 'img/avatar/avatar.png';

        if ($user->role === 'room_owner') {
            OwnerProfile::create(['user_id' => $user->user_id, 'avatar' => $avatar]);
        } else {
            Profile::create(['user_id' => $user->user_id, 'avatar' => $avatar]);
        }
    }


}
