<?php

namespace App\Jobs;

use App\Models\Guest\GuestInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\WhatsAppNotification; // Import WhatsApp Notification

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $guestlist;
    protected $invitation;
    protected $callback;
    protected $notificationClass;

    /**
     * Create a new job instance.
     */
    public function __construct($guestlist, $invitation, $notificationClass, $callback)
    {
        $this->guestlist = $guestlist;
        $this->invitation = $invitation;
        $this->callback = $callback;
        $this->notificationClass = $notificationClass;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            foreach ($this->guestlist as $guest) {
                Notification::send($guest, new $this->notificationClass($this->invitation->host, $this->invitation, 'sent you invitation'));
    
                // ✅ WhatsApp Notification
                if (!empty($guest->mobile)) {
                    Notification::send($guest, new WhatsAppNotification($this->invitation));
                }
    
                // ✅ Update DB
                GuestInvitation::where('user_id', $guest->id)
                    ->where('invitation_id', $this->invitation->id)
                    ->first()
                    ->update(['email' => 2, 'watsapp' => 2]);
            }
        } catch (\Exception $e) {
            \Log::error("SendNotificationJob Failed: " . $e->getMessage());
        }
    }
    
}
