<?php

namespace App\Notifications\Guest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationNotifications extends Notification
{
    use Queueable;
    public $user, $profile, $invitation, $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $invitation, $status)
    {
        $this->user = $user;
        $this->profile = $user->profile;
        $this->invitation = $invitation;
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
            'user' => $this->user,
            'profile' => $this->profile,
            'invitation' => $this->invitation,
            'status' => $this->status
        ];
    }
}
