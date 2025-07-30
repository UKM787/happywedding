<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\MSG91WatsappChannel;

class WhatsAppNotification extends Notification
{
    use Queueable;

    protected $invitation;

    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    public function via($notifiable)
    {
        return ['App\Notifications\Channels\MSG91WatsappChannel'];
    }


    public function toMSG91Watsapp($notifiable)
    {
        return [
            "integrated_number" => "919360777089",
            "content_type" => "template",
            "payload" => [
                "type" => "template",
                "template" => [
                    "name" => "invitation_new",
                    "language" => ["code" => "en", "policy" => "deterministic"],
                    "namespace" => "bc3735fb_a2e9_4e83_8b62_377bca25c09f",
                    "to_and_components" => [
                        [
                            "to" => ["91" . $notifiable->mobile],
                            "components" => [
                                "body_1" => ["type" => "text", "value" => $this->invitation->brideName],
                                "body_2" => ["type" => "text", "value" => $this->invitation->groomName],
                                "body_3" => ["type" => "text", "value" => date("d-m-Y", strtotime($this->invitation->startDate))],
                                "body_4" => ["type" => "text", "value" => "https://happywed.in"]
                            ]
                        ]
                    ]
                ],
                "messaging_product" => "whatsapp"
            ]
        ];
    }
}
