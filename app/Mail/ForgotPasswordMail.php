<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * ForgotPasswordMail for sending mail when change the password.
 * @author Zin Lin Htet
 * @created 10/07/2023
 */
class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $mail;
    public function __construct($mail)
    {
        $this->mail = $mail;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    /**
     * Handles the mail sending
     * @author Zin Lin Htet
     * @created 10/07/2023
     * @return 'view'
     */
    public function build()
    {
        return $this->subject($this->mail['subject'])
            ->view('emails.otpmail', ['mail' => $this->mail]);
    }
}
