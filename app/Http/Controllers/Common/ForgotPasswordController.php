<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

    /**
     * ================================================
     * Show the application forgot password form.
     *=================================================
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * ================================================
     * Send otp to the user.
     *=================================================
     */

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);

        // Delete any existing OTP record for the user
        Otp::where('email', $request->email)->delete();

        // Store the OTP in the database
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send the OTP via email

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }


        try {
            Mail::to($request->email)->send(new \App\Mail\ForgotPassword($otp));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send OTP. Please try again later.'], 500);
        }

        session(['otp_email' => $request->email]);

        return response()->json(['success' => 'OTP sent to your email.', 200]);
    }

    /**
     * ================================================
     * Verify the OTP 
     *=================================================
     */
    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required'
        ]);

        $email = session('otp_email');

        $record = Otp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json(['error' => 'Invalid or expired OTP'], 400);
        }
        
        $record->is_used = true;
        $record->save();


        return response()->json(['success' => 'OTP verified successfully.'], 200);

    }
    /**
     * ================================================
     * Reset the user password.
     *=================================================
     */

    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $email = session('otp_email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the OTP record
        Otp::where('email', $email)->delete();

        session()->forget('otp_email');


        return response()->json(['success' => 'Password reset successfully.'], 200);



    }

}
