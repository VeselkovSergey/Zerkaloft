<?php


namespace App\Helpers;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $password = $this->password;
        $email = $this->to[0]['address'];
        return $this->view('mail.view', compact('password', 'email'))->subject(env('APP_NAME'));
    }
}
