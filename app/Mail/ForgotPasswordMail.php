<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $id, $name, $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $id, $name, $token)
    {
        $this->email = $email;
        $this->id = $id;
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('forgotpasswordemail')
        ->from('twinkle@webtech-evolution.com')
        ->subject('Password Reset');
    }
}
