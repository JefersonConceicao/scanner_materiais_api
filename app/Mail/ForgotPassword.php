<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\BTEmailTemplate;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**

     * @return void
     */
    public function __construct($user, $token)
    {   
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Recuperação de senha | Não responda')
            ->view('mails.reset_password')
            ->with('user', $this->user)
            ->with('token', $this->token);        
    }
}
