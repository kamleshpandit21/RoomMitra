<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    //

    /**
     * ================================================
     * Show the application forgot password form.
     *=================================================
     */
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        // Validate password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        // Update password in the database
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete OTP record after reset
        Otp::where('email', $request->email)->delete();

        // Redirect to login page
        return redirect()->route('common.login')->with('success', 'Password reset successfully.');
    }

}
