<?php
// Trong file ConfirmationEmail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $check_comfirm;

    public function __construct($email, $check_comfirm)
    {
        $this->email = $email;
        $this->check_comfirm = $check_comfirm;
    }

    public function build()
    {
        // return "bạn ơi";
        return $this->view('emails.confirmation');
        // return $this->view('demo');
    }
}
