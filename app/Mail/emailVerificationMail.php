<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class emailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

      public function __construct($user){
        $this->user=$user;
     }

     public function build(){
        return $this->subject('Your Verification Code')
            ->view('Backend.Layouts.Email.emailVerification')
            ->with(['user' => $this->user]);
     }
}
