<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $action_link;
    public $name;
    public $pic;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $user)
    {
        $this->action_link = $link;
        $this->name = $user->name;
       // $this->pic = $user->profile->imageOne ? 'https://happywed.in/assets/hosts/uploads/'.$user->profile->imageOne : null ;
        $this->pic = null;
        //dd($this->pic);
        //http://wedding.test/storage/defaultsv1/avatar.png
        //http://wedding.test/assets/hosts/uploads/viddhant-gautam-5992/1674127483-personal.jpg
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
            $message->setdata([ 'data' =>['actionLink' => $this->action_link, 'userName' => $this->name, 'userPicture' => $this->pic], 'template' => 'Reset_Password_Happywed']);
        });
        return $this;
    }
}
