<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    public $action_link;
    public $name;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $user)
    {
        $this->action_link = $link;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->to);
        $this->view('dummy');
        $this->withSwiftMessage(function ($message) {
            $message->setdata([ 'data' =>['actionLink' => $this->action_link, 'userName' => $this->name, 'userEmail' => $this->email], 'template' => 'Email_Verfication_Happywed']);
        });
        return $this;
    }
}
