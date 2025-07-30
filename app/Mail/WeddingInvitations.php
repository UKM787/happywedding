<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeddingInvitations extends Mailable
{
    use Queueable, SerializesModels;

    public $link, $key, $value;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $key, $value)
    {
       $this->link = $link;
       $this->key = $key;
       $this->value = $value;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $this->withSwiftMessage(function ($message) {
        //     dd($message->getHeaders(), 'ss');
        //     $message->getHeaders()->addTextHeader(
        //         'Custom-Header', 'Header Value'
        //     );
        // }); 
        return $this->markdown('host.emails.newinvitations')
        ->subject("Inviting your to attend the marriage");
    }
}
