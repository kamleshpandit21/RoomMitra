<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class CommonOtpController extends Controller
{

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
            ]
        );

        try {
            Mail::to($request->email)->send(new ForgotPassword($otp));

            return back()->with('success', 'OTP sent to your email.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again later.']);
        }
    }

    public function verifyOtp(Request $request)
    {
        // Validate OTP and email
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        // Check OTP validity
        $record = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        // Redirect to password reset form
        return redirect()->route('password.reset-form')->with('email', $request->email);
    }
}
