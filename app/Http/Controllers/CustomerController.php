<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        // Check or create customer (find by email)
        $customer = Customer::firstOrCreate(
            ['email' => $email],
            [
                'first_name' => '',
                'last_name' => '',
                'phone' => '',
                'address' => '',
                'city' => '',
            ]
        );

        // Generate 4-digit OTP
        $otp = random_int(1000, 9999);

        // Save to DB
        $customer->otp = $otp;
        $customer->is_validated = false;
        $customer->validated_at = null;
        $customer->save();

        // Send mail (use Laravel default)
        Mail::raw("Your verification code is: $otp", function ($message) use ($email) {
            $message->to($email)
                ->subject('Your Email Verification Code');
        });

        return response()->json(['success' => true]);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4'
        ]);

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer || !$customer->otp) {
            return response()->json(['success' => false, 'msg' => 'OTP not sent. Please request OTP.'], 422);
        }

        if ($customer->otp != $request->otp) {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP!'], 422);
        }

        // Success
        $customer->is_validated = true;
        $customer->validated_at = Carbon::now();
        $customer->otp = null;
        $customer->save();

        return response()->json(['success' => true]);
    }
}
