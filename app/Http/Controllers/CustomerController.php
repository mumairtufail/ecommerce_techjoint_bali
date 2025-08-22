<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // Send OTP
 public function sendOtp(Request $request)
    {
        Log::info("sendOtp() called", ['request' => $request->all()]);

        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        Log::info("Looking up customer by email", ['email' => $email]);

        // Check or create customer
        $customer = Customer::firstOrCreate(
            ['email' => $email],
            [
                'first_name' => '',
                'last_name'  => '',
                'phone'      => '',
                'address'    => '',
                'city'       => '',
            ]
        );

        Log::info("Customer record found/created", ['customer_id' => $customer->id]);

        // Generate 4-digit OTP
        $otp = random_int(1000, 9999);
        Log::info("Generated OTP", ['otp' => $otp, 'email' => $email]);

        // Save OTP in DB
        $customer->otp = $otp;
        $customer->is_validated = false;
        $customer->validated_at = null;
        $customer->save();

        Log::info("Customer OTP saved to database", [
            'customer_id' => $customer->id,
            'otp' => $otp
        ]);

        try {
            Log::info("Attempting to send mail", ['email' => $email]);

            // Attempt to send mail
            Mail::raw("Your verification code is: $otp", function ($message) use ($email) {
                $message->to($email)
                    ->subject('Your Email Verification Code');
            });

            Log::info("Mail send executed (check if actually delivered)", [
                'email' => $email,
                'otp'   => $otp,
            ]);

            return response()->json([
                'success' => true,
                'msg'     => 'OTP sent successfully.'
            ]);

        } catch (\Exception $e) {
            // Log and return error
            Log::error("Mail exception occurred", [
                'email' => $email,
                'otp'   => $otp,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'msg'     => 'An error occurred while sending OTP.'
            ], 500);
        }
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
