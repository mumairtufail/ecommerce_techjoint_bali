<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class CustomerOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

public function build()
{
    Log::info('Building OTP Mail', ['otp' => $this->otp, 'email' => $this->email]);

    return $this->subject('Your OTP Code')
                ->view('emails.otp')
                ->with([
                    'otp' => $this->otp,
                ]);
}
}
