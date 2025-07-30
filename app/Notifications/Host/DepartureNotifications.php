<?php

namespace App\Notifications\Host;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepartureNotifications extends Notification
{
    use Queueable;

    public $host, $profile, $departure, $status;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($host, $departure, $status)
    {
        $this->host = $host;
        $this->profile = $host->profile;
        $this->departure = $departure;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'host' => $this->host,
            'profile' => $this->profile,
            'departure' => $this->departure,
            'status' => $this->status
        ];
    }
}
