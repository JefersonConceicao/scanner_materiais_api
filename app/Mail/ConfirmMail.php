<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return $this
     */
    public function build()
    {   
        $user = new User;

        return $this
            ->subject('Confirmação de Conta')
            ->view('mails.confirm_email')
            ->with('user', $user->where('mail_token', $this->token)->first())
            ->with('token', $this->token);
    }
}
