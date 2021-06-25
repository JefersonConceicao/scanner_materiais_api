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
        $templateMail = new BTEmailTemplate;
        $html = $template->where('titulo', 'RECUPERAR SENHA');
        
        dd($html);
    }
}
